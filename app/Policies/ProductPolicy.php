<?php

namespace App\Policies;

use App\Model\Admin;
use App\Model\Product;
use App\Model\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Admin can manage all products
     */
    public function manageByAdmin(Admin $admin)
    {
        return true;
    }

    /**
     * Seller can view their own products
     */
    public function view(Seller $seller, Product $product)
    {
        return $seller->id === $product->seller_id;
    }

    /**
     * Seller can create products
     */
    public function create(Seller $seller)
    {
        return $seller->status === 'approved';
    }

    /**
     * Seller can update their own products (only if not approved, or if edit is pending)
     */
    public function update(Seller $seller, Product $product)
    {
        if ($seller->id !== $product->seller_id) {
            return false;
        }

        // Can edit if product is not yet approved
        if (in_array($product->approval_status, ['draft', 'pending', 'rejected'])) {
            return true;
        }

        // Can edit if product is pending edit
        if ($product->approval_status === 'pending_edit') {
            return true;
        }

        // Cannot edit approved products directly (must request edit)
        return false;
    }

    /**
     * Seller can delete their own products
     */
    public function delete(Seller $seller, Product $product)
    {
        return $seller->id === $product->seller_id;
    }

    /**
     * Check if product can be edited (for UI purposes)
     */
    public function canEdit(Seller $seller, Product $product)
    {
        return $this->update($seller, $product);
    }

    /**
     * Check if product needs re-approval after edit
     */
    public function needsReapproval(Product $product)
    {
        return $product->approval_status === 'approved' && $product->edit_status === 'pending_edit';
    }
}
