<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateProductIndexing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:update-indexing';

    /**
     * The console command description.
     *
     * @var string 
     */
    protected $description = 'Updates product sorting indexing based on price, review ratings, and stock limits';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Resetting old indexes...');
        DB::statement("UPDATE products SET indexing = NULL");

        $this->info('Calculating and saving new product indexes...');

        $query = "
          UPDATE products p
JOIN (
    SELECT 
        ranked.id,

        -- 🔥 Dynamic shifting
        DENSE_RANK() OVER(
            PARTITION BY ranked.grp
            ORDER BY ranked.priority
        ) as rn

    FROM (
        SELECT 
            p_sub.id,

            COALESCE(NULLIF(p_sub.pid, ''), CAST(p_sub.id AS CHAR)) as grp,

            p_sub.actual_amount as final_price,

            CASE 

                -- 0️⃣ Featured product gets top priority in group
                WHEN p_sub.featured = 1 THEN 0

                -- 1️⃣ Cheapest + High Reviews + High Stock
                WHEN 
                    p_sub.actual_amount =
                        MIN(p_sub.actual_amount) OVER(
                            PARTITION BY COALESCE(NULLIF(p_sub.pid, ''), CAST(p_sub.id AS CHAR))
                        )
                    AND COALESCE(r.review_count, 0) > 0
                THEN 1

                -- 2️⃣ Not Cheapest + High Reviews + High Stock
                WHEN 
                    p_sub.actual_amount >
                        MIN(p_sub.actual_amount) OVER(
                            PARTITION BY COALESCE(NULLIF(p_sub.pid, ''), CAST(p_sub.id AS CHAR))
                        )
                    AND COALESCE(r.review_count, 0) > 0
                THEN 2

                -- 3️⃣ Cheapest + Low Reviews + High Stock
                WHEN 
                    p_sub.actual_amount =
                        MIN(p_sub.actual_amount) OVER(
                            PARTITION BY COALESCE(NULLIF(p_sub.pid, ''), CAST(p_sub.id AS CHAR))
                        )
                    AND COALESCE(r.review_count, 0) = 0
                THEN 3

                -- 4️⃣ बाकी सब
                ELSE 3

            END as priority

        FROM products p_sub

        LEFT JOIN (
            SELECT 
                product_id, 
                COUNT(id) as review_count
            FROM reviews 
            WHERE status = 1 AND rating >= 3
            GROUP BY product_id
        ) r ON p_sub.id = r.product_id

        -- 🔥 Only duplicate products
        INNER JOIN (
            SELECT 
                COALESCE(NULLIF(pid, ''), CAST(id AS CHAR)) as grp
            FROM products
            WHERE status = 1
            GROUP BY grp
            HAVING COUNT(*) > 1
        ) dup 
        ON dup.grp = COALESCE(NULLIF(p_sub.pid, ''), CAST(p_sub.id AS CHAR))

        WHERE p_sub.status = 1 
          AND p_sub.current_stock > 0

    ) ranked

) t ON p.id = t.id

SET p.indexing = t.rn
        ";

        DB::statement($query);



$this->info('Setting indexing = 1 for single products...');

DB::statement("
    UPDATE products
    SET indexing = 1
    WHERE status = 1
      AND current_stock > 0
      AND COALESCE(NULLIF(pid, ''), CAST(id AS CHAR)) NOT IN (
            SELECT grp FROM (
                SELECT COALESCE(NULLIF(pid, ''), CAST(id AS CHAR)) as grp
                FROM products
                WHERE status = 1
                GROUP BY grp
                HAVING COUNT(*) > 1
            ) t
      )
");

$this->info('Product indexes updated successfully!');
return 0;
    }
}
