<?php
namespace App\Helpers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Attribute;
use App\Model\Color;

/**
 * Formats raw change‑request values into human‑readable strings.
 */
class ChangeRequestFormatter
{
    /**
     * Format a value based on its field key.
     *
     * @param string $key   The database column / request key.
     * @param mixed  $value Raw value (scalar, JSON string, array, etc.).
     * @param array  $maps  Preloaded lookup maps: brandMap, categoryMap, attributeMap, choiceAttrMap, colorMap.
     * @return string
     */
    public static function format(string $key, $value, array $maps = []): string
    {
        if (is_null($value) || $value === '') {
            return '—';
        }

        // Decode JSON strings when possible
        if (is_string($value) && (str_starts_with(trim($value), '[') || str_starts_with(trim($value), '{'))) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $value = $decoded;
            }
        }

        // Brand lookup
        if ($key === 'brand_id') {
            return self::formatBrand($value, $maps['brandMap'] ?? []);
        }

        // Category IDs (array of objects with id and position)
        if (str_contains($key, 'category') && is_array($value)) {
            return self::formatCategories($value, $maps['categoryMap'] ?? []);
        }

        // Colors
        if ($key === 'colors') {
            return self::formatColors($value, $maps['colorMap'] ?? []);
        }

        // Attributes
        if ($key === 'attributes') {
            return self::formatAttributes($value, $maps['attributeMap'] ?? []);
        }

        // Choice Attributes
        if ($key === 'choice_attributes') {
            return self::formatChoiceAttributes($value, $maps['choiceAttrMap'] ?? []);
        }

        // Variations - convert to readable table
        if ($key === 'variation' && is_array($value)) {
            return self::formatVariations($value);
        }

        // Stocks
        if ($key === 'stocks') {
            return self::formatStocks($value);
        }

        // Images - list file names
        if ($key === 'images' && is_array($value)) {
            return self::formatImages($value);
        }

        // Thumbnail / Meta image
        if (in_array($key, ['thumbnail', 'meta_image']) && is_string($value)) {
            return $value;
        }

        // Translations - show language codes
        if ($key === 'translations' && is_array($value)) {
            return implode(', ', array_keys($value));
        }

        // Description - strip HTML tags for a short preview
        if ($key === 'description' && is_string($value)) {
            return strip_tags($value);
        }

        // Price fields - format with currency
        if (is_numeric($value) && str_contains($key, 'price')) {
            return self::formatPrice($value);
        }

        // Discount fields
        if (in_array($key, ['discount', 'admin_commission']) && is_numeric($value)) {
            return number_format($value, 2);
        }

        // Tax
        if ($key === 'tax' && is_numeric($value)) {
            return number_format($value, 2) . '%';
        }

        // Unit price, purchase price
        if (in_array($key, ['unit_price', 'purchase_price', 'shipping_cost']) && is_numeric($value)) {
            return self::formatPrice($value);
        }

        // Minimum order qty
        if ($key === 'minimum_order_qty' && is_numeric($value)) {
            return (int)$value;
        }

        // Discount type
        if ($key === 'discount_type') {
            return self::formatDiscountType($value);
        }

        // Tax model
        if ($key === 'tax_model') {
            return self::formatTaxModel($value);
        }

        // Product type
        if ($key === 'product_type') {
            return self::formatProductType($value);
        }

        // Video provider
        if ($key === 'video_provider') {
            return ucfirst(strtolower($value));
        }

        // Admin commission type
        if ($key === 'admin_commission_type') {
            return self::formatAdminCommissionType($value);
        }

        // Choice options
        if ($key === 'choice_options' && is_array($value)) {
            return self::formatChoiceOptions($value);
        }

        // Digital product type
        if ($key === 'digital_product_type') {
            return ucfirst(str_replace('_', ' ', strtolower($value)));
        }

        // Fallback - if still array, pretty-print JSON
        if (is_array($value)) {
            return self::formatArray($value);
        }

        return (string) $value;
    }

    /**
     * Format brand ID to brand name.
     */
    private static function formatBrand($value, array $brandMap): string
    {
        if (empty($value)) {
            return '—';
        }
        $id = is_array($value) ? ($value[0]['id'] ?? $value[0] ?? null) : $value;
        if ($id === null) {
            return '—';
        }
        return $brandMap[$id] ?? "Unknown Brand (ID: {$id})";
    }

    /**
     * Format category IDs to category names.
     */
    private static function formatCategories(array $categories, array $categoryMap): string
    {
        if (empty($categories)) {
            return '—';
        }

        $names = [];
        foreach ($categories as $cat) {
            $id = $cat['id'] ?? $cat;
            if ($id === null) continue;
            $names[] = $categoryMap[$id] ?? "Unknown Category (ID: {$id})";
        }

        return implode(', ', $names);
    }

    /**
     * Format colors to color names with codes.
     */
    private static function formatColors($value, array $colorMap): string
    {
        if (empty($value)) {
            return '—';
        }

        // Handle JSON string
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $value = $decoded;
            }
        }

        if (!is_array($value) || empty($value)) {
            return '—';
        }

        $names = [];
        foreach ($value as $color) {
            if (is_string($color)) {
                $names[] = $color;
            } elseif (is_array($color)) {
                // Could be {id: 1, code: '#FF0000'} or just ID
                if (isset($color['code']) && isset($color['id'])) {
                    $name = $colorMap[$color['id']] ?? ($color['name'] ?? null);
                    $code = $color['code'];
                    $names[] = $name ? "{$name} ({$code})" : $code;
                } elseif (isset($color['id'])) {
                    $names[] = $colorMap[$color['id']] ?? "Color ID: {$color['id']}";
                } elseif (isset($color['code'])) {
                    $names[] = $color['code'];
                }
            }
        }

        return empty($names) ? '—' : implode(', ', $names);
    }

    /**
     * Format attribute IDs to attribute names.
     */
    private static function formatAttributes($value, array $attributeMap): string
    {
        if (empty($value)) {
            return '—';
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $value = $decoded;
            }
        }

        $ids = is_array($value) ? $value : [$value];
        $names = [];
        foreach ($ids as $id) {
            if ($id === null) continue;
            $names[] = $attributeMap[$id] ?? "Attribute ID: {$id}";
        }

        return empty($names) ? '—' : implode(', ', $names);
    }

    /**
     * Format choice attribute IDs to names.
     */
    private static function formatChoiceAttributes($value, array $choiceAttrMap): string
    {
        if (empty($value)) {
            return '—';
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $value = $decoded;
            }
        }

        $ids = is_array($value) ? $value : [$value];
        $names = [];
        foreach ($ids as $id) {
            if ($id === null) continue;
            $names[] = $choiceAttrMap[$id] ?? "Choice Attribute ID: {$id}";
        }

        return empty($names) ? '—' : implode(', ', $names);
    }

    /**
     * Format variations into a readable HTML table.
     */
    private static function formatVariations(array $variations): string
    {
        if (empty($variations)) {
            return '—';
        }

        $html = '<table class="table table-sm table-bordered mb-0" style="font-size: 0.85rem;">';
        $html .= '<thead class="thead-light"><tr>';
        $html .= '<th>Type</th><th class="text-right">Price</th><th>SKU</th><th class="text-right">Qty</th>';
        $html .= '</tr></thead><tbody>';

        foreach ($variations as $var) {
            $type = $var['type'] ?? $var['name'] ?? '—';
            $price = isset($var['price']) ? self::formatPrice($var['price']) : '—';
            $sku = $var['sku'] ?? '—';
            $qty = $var['qty'] ?? $var['quantity'] ?? '—';

            $html .= "<tr>";
            $html .= "<td>{$type}</td>";
            $html .= "<td class=\"text-right\">{$price}</td>";
            $html .= "<td>{$sku}</td>";
            $html .= "<td class=\"text-right\">{$qty}</td>";
            $html .= "</tr>";
        }

        $html .= '</tbody></table>';
        return $html;
    }

    /**
     * Format stocks data.
     */
    private static function formatStocks($value): string
    {
        if (empty($value)) {
            return '—';
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $value = $decoded;
            }
        }

        if (!is_array($value) || empty($value)) {
            return '—';
        }

        $parts = [];
        foreach ($value as $stock) {
            if (is_array($stock)) {
                $variant = $stock['variant'] ?? $stock['type'] ?? 'Default';
                $qty = $stock['qty'] ?? $stock['quantity'] ?? 0;
                $parts[] = "{$variant}: {$qty}";
            }
        }

        return empty($parts) ? '—' : implode(', ', $parts);
    }

    /**
     * Format images array.
     */
    private static function formatImages(array $images): string
    {
        if (empty($images)) {
            return '—';
        }
        return implode(', ', array_map(fn($img) => basename($img), $images));
    }

    /**
     * Format price with currency symbol.
     */
    private static function formatPrice($value): string
    {
        return '₹' . number_format((float)$value, 2);
    }

    /**
     * Format discount type.
     */
    private static function formatDiscountType($value): string
    {
        $types = [
            'percent' => 'Percentage',
            'percentage' => 'Percentage',
            'flat' => 'Flat Amount',
            'amount' => 'Flat Amount',
        ];
        return $types[strtolower($value)] ?? ucfirst(strtolower($value));
    }

    /**
     * Format tax model.
     */
    private static function formatTaxModel($value): string
    {
        $models = [
            'inclusive' => 'Inclusive',
            'exclusive' => 'Exclusive',
        ];
        return $models[strtolower($value)] ?? ucfirst(strtolower($value));
    }

    /**
     * Format product type.
     */
    private static function formatProductType($value): string
    {
        $types = [
            'physical' => 'Physical',
            'digital' => 'Digital',
        ];
        return $types[strtolower($value)] ?? ucfirst(strtolower($value));
    }

    /**
     * Format admin commission type.
     */
    private static function formatAdminCommissionType($value): string
    {
        $types = [
            'percent' => 'Percentage',
            'percentage' => 'Percentage',
            'flat' => 'Flat Amount',
            'amount' => 'Flat Amount',
        ];
        return $types[strtolower($value)] ?? ucfirst(strtolower($value));
    }

    /**
     * Format choice options.
     */
   private static function formatChoiceOptions(array $options): string
{
    if (empty($options)) {
        return '—';
    }

    $parts = [];

    foreach ($options as $key => $values) {
        if (!is_array($values)) {
            $values = [$values];
        }

        $formattedValues = array_map(function ($value) {
            if (is_array($value)) {
                return implode(', ', array_map('strval', $value));
            }

            if (is_object($value)) {
                return method_exists($value, '__toString')
                    ? (string) $value
                    : json_encode($value);
            }

            return (string) $value;
        }, $values);

        $parts[] = "{$key}: " . implode(', ', $formattedValues);
    }

    return implode('; ', $parts);
}   
    /**
     * Generic array formatting.
     */
    private static function formatArray(array $value): string
    {
        $parts = [];
        foreach ($value as $k => $v) {
            if (is_scalar($v)) {
                $parts[] = "{$k}: {$v}";
            }
        }
        return empty($parts) ? '—' : implode(', ', $parts);
    }
}