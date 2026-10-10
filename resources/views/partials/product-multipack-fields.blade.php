{{--
    Shared "Multipack Variants (Big Savings)" repeater for admin + seller product add/edit forms.

    Usage:  @include('partials.product-multipack-fields')

    - Renders existing multipack rows when editing (reads $product->packs type=multi).
    - Add / Remove rows client-side (no page reload).
    - Submits as arrays: multipack[name][], multipack[price][], ... (order-aligned).
    - Controllers persist these into the `product_packs` table with type = 'multi'.
--}}
<div class="card mt-2 rest-part">
    <div class="card-header">
        <h4 class="mb-0">Multipack Variants (Big Savings)</h4>
    </div>
    <div class="card-body">
        <p class="text-muted mb-3" style="font-size: 13px;">
            Optional — bundle packs (e.g. <b>1 ltr &times; 2 Pack</b>) shown in the
            <b>"Multipack (Big Savings)"</b> section on the product detail page.
            Leave empty to hide that section.
        </p>

        @php
            $bhExistingMultipacks = collect();
            if (!empty($product)) {
                $bhExistingMultipacks = $product->packs()->where('type', 'multi')->orderBy('sort_order')->get();
            }
        @endphp

        <div id="bhMpRows">
            @foreach ($bhExistingMultipacks as $mp)
                <div class="border rounded p-3 mb-2 bh-mp-row">
                    <div class="row">
                        <div class="col-md-3 form-group mb-2">
                            <label class="title-color">Pack Name</label>
                            <input type="text" name="multipack[name][]" class="form-control" value="{{ $mp->name }}" placeholder="1 ltr x 2 Pack">
                        </div>
                        <div class="col-md-3 form-group mb-2">
                            <label class="title-color">Sub Label</label>
                            <input type="text" name="multipack[sub][]" class="form-control" value="{{ $mp->sub }}" placeholder="2 ltr">
                        </div>
                        <div class="col-md-2 form-group mb-2">
                            <label class="title-color">Price</label>
                            <input type="number" step="0.01" min="0" name="multipack[price][]" class="form-control" value="{{ $mp->price }}">
                        </div>
                        <div class="col-md-2 form-group mb-2">
                            <label class="title-color">MRP</label>
                            <input type="number" step="0.01" min="0" name="multipack[mrp][]" class="form-control" value="{{ $mp->mrp }}">
                        </div>
                        <div class="col-md-2 form-group mb-2">
                            <label class="title-color">Discount %</label>
                            <input type="number" step="1" min="0" max="100" name="multipack[discount][]" class="form-control" value="{{ $mp->discount }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group mb-2">
                            <label class="title-color">Unit Rate</label>
                            <input type="text" name="multipack[unit_rate][]" class="form-control" value="{{ $mp->unit_rate }}" placeholder="&#8377;786.00/1 ltr">
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="title-color">Badge</label>
                            <input type="text" name="multipack[badge][]" class="form-control" value="{{ $mp->badge }}" placeholder="Save &#8377;26">
                        </div>
                        <div class="col-md-4 form-group mb-2">
                            <label class="title-color">&nbsp;</label>
                            <button type="button" class="btn btn-outline-danger btn-block bh-mp-remove">Remove</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-sm btn-primary mt-2" id="bhMpAddBtn">+ Add Multipack</button>
    </div>
</div>

<script>
    (function () {
        function bhMpRowHtml() {
            return '' +
            '<div class="border rounded p-3 mb-2 bh-mp-row">' +
                '<div class="row">' +
                    '<div class="col-md-3 form-group mb-2"><label class="title-color">Pack Name</label>' +
                        '<input type="text" name="multipack[name][]" class="form-control" placeholder="1 ltr x 2 Pack"></div>' +
                    '<div class="col-md-3 form-group mb-2"><label class="title-color">Sub Label</label>' +
                        '<input type="text" name="multipack[sub][]" class="form-control" placeholder="2 ltr"></div>' +
                    '<div class="col-md-2 form-group mb-2"><label class="title-color">Price</label>' +
                        '<input type="number" step="0.01" min="0" name="multipack[price][]" class="form-control"></div>' +
                    '<div class="col-md-2 form-group mb-2"><label class="title-color">MRP</label>' +
                        '<input type="number" step="0.01" min="0" name="multipack[mrp][]" class="form-control"></div>' +
                    '<div class="col-md-2 form-group mb-2"><label class="title-color">Discount %</label>' +
                        '<input type="number" step="1" min="0" max="100" name="multipack[discount][]" class="form-control"></div>' +
                '</div>' +
                '<div class="row">' +
                    '<div class="col-md-4 form-group mb-2"><label class="title-color">Unit Rate</label>' +
                        '<input type="text" name="multipack[unit_rate][]" class="form-control" placeholder="&#8377;786.00/1 ltr"></div>' +
                    '<div class="col-md-4 form-group mb-2"><label class="title-color">Badge</label>' +
                        '<input type="text" name="multipack[badge][]" class="form-control" placeholder="Save &#8377;26"></div>' +
                    '<div class="col-md-4 form-group mb-2"><label class="title-color">&nbsp;</label>' +
                        '<button type="button" class="btn btn-outline-danger btn-block bh-mp-remove">Remove</button></div>' +
                '</div>' +
            '</div>';
        }

        document.addEventListener('DOMContentLoaded', function () {
            var addBtn = document.getElementById('bhMpAddBtn');
            var rows = document.getElementById('bhMpRows');
            if (!addBtn || !rows) return;

            addBtn.addEventListener('click', function () {
                rows.insertAdjacentHTML('beforeend', bhMpRowHtml());
            });

            rows.addEventListener('click', function (e) {
                var t = e.target;
                if (t && t.classList && t.classList.contains('bh-mp-remove')) {
                    var row = t.closest('.bh-mp-row');
                    if (row) row.remove();
                }
            });
        });
    })();
</script>
