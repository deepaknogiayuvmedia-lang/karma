@extends('layouts.back-end.sale_app')
@section('title', \App\CPU\translate('Product Query'))
@push('css_or_js')
@endpush

@section('content')
    <style>
        .required-field::before {
            content: "* ";
            color: red;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-2">
                <div class="card">
                    <div class="card-header">
                        Add/Edit Order - fill the requirement fields
                    </div>
                    <div class="card-body">
                        <form class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label required-field" for="inlineFormSelectPref">DID No.</label>
                                <select class="form-control" id="inlineFormSelectPref" required>
                                    <option selected>Choose...</option>
                                    <option value="inbound">Inbound</option>
                                    <option value="outbound">Outbound</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label required-field">Incoming call No</label>
                                <input type="text" class="form-control" id="inputPassword4" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputAddress" class="form-label">Mobile No.</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder=""
                                    pattern="[0-9]{10}" value="{{ $query->mobile }}" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputAddress2" class="form-label">Agent Name</label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputCity" class="form-label required-field">Customer</label>
                                <input type="text" class="form-control" id="inputCity" value="{{ $query->name }}"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputCity" class="form-label required-field">Channel ID</label>
                                <select class="form-control" id="inlineFormSelectPref" required>
                                    @foreach ($chanals as $list)
                                        <option value="{{ $list->id }}"
                                            {{ $list->id == $query->chanal_id ? 'selected' : null }}>{{ $list->name }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control" value="{{ $query->chanal_id }}" id="inputCity" required /> --}}
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required-field" for="inlineFormSelectPref">Gender</label>
                                <select class="form-control" id="inlineFormSelectPref" required>
                                    <option selected>Choose...</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label required-field">Blood Group</label>
                                <input type="text" class="form-control" id="inputZip" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label required-field">Weight(kg)</label>
                                <input type="text" class="form-control" id="inputZip" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label required-field">Age</label>
                                <input type="text" class="form-control" id="inputZip" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label required-field">Disease/Problem</label>
                                <input type="text" class="form-control" id="inputZip" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label required-field">Height</label>
                                <input type="text" class="form-control" id="inputZip" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required-field" for="inlineFormSelectPref">Disposition Lavel
                                    1</label>
                                <select class="form-control" id="inlineFormSelectPref" required>
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required-field" for="inlineFormSelectPref">Occupation</label>
                                <select class="form-control" id="inlineFormSelectPref" required>
                                    <option selected>Choose...</option>
                                    <option value="business">Business</option>
                                    <option value="service">Service</option>
                                    <option value="housewife">House wife</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label">Hospital Name</label>
                                <input type="text" value="Herbanix
                                "
                                    class="form-control" id="inputZip" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required-field" for="inlineFormSelectPref">Disposition Lavel
                                    2</label>
                                <select class="form-control" id="inlineFormSelectPref" required>
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleFormControlTextarea1"
                                    class="form-label required-field">Comments/Remarks</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 p-2">
                <div class="card">
                    <div class="card-header">Billing Information</div>
                    <div class="card-body">
                        <form class="row g-2">
                            <div class="col-md-12">
                                <label for="exampleFormControlTextarea1" class="form-label required-field">Address
                                    1</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label required-field">Pincode</label>
                                <input type="text" class="form-control" value="{{ $query->address }}"
                                    id="inputPassword4" required readonly />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label required-field" for="inlineFormSelectPref">Post Office</label>
                                <select class="form-control" id="inlineFormSelectPref" required>
                                    @foreach ($postofficedata as $post)
                                        <option value="{{ $post->OfficeName }}">{{ $post->OfficeName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputAddress" class="form-label required-field">Tehsil</label>
                                <input type="text" class="form-control" value="{{ $postofficesingle->District }}"
                                    id="inputAddress" placeholder="" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputAddress2" class="form-label required-field">City</label>
                                <input type="text" class="form-control" value="{{ $postofficesingle->District }}"
                                    id="inputAddress2" placeholder="" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputAddress" class="form-label required-field">State</label>
                                <input type="text" class="form-control" value="{{ $postofficesingle->StateName }}"
                                    id="inputAddress" placeholder="" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputCity" class="form-label">Country</label>
                                <input type="text" class="form-control" value="India" id="inputCity" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Choose Products</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="2">Products</th>
                                        <th scope="col" class="text-end">Quantity</th>
                                        <th scope="col" class="text-end">Price</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    <!---Appends here-->
                                </tbody>
                            </table>

                            <div class="card">
                                <div class="card-header">
                                    Select the product name and quantity
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <input type="hidden" id="customerid" name="customerid"
                                                        value="{{ $customer->id }}">
                                                    <td class="w-75">
                                                        <select class="form-control" id="productid" required>
                                                            @foreach ($products as $products)
                                                                <option value="{{ $products->id }}"
                                                                    {{ $products->id == $query->product_id ? 'selected' : null }}>
                                                                    {{ $products->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="w-25">
                                                        <input type="number" id="qty" class="form-control"
                                                            id="inputPassword4" required />
                                                    </td>
                                                    <td class="text-end">
                                                        <button type="button" class="btn btn-success"
                                                            id="addtoproduct">Add</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <form class="row g-2 mt-1">
                                        <div class="col-md-6">
                                            <label for="inputZip" class="form-label">Shipping Charges</label>
                                            <input type="text" class="form-control" id="inputZip" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputZip" class="form-label">COD Charge</label>
                                            <input type="text" class="form-control" id="inputZip" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputZip" class="form-label">Discount Amount</label>
                                            <input type="text" class="form-control" id="inputZip" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputZip" class="form-label required-field">Total Payable
                                                amount</label>
                                            <input type="text" class="form-control" id="inputZip" required
                                                disabled />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Helpers::product_data_formatting(json_decode($order['product_details'], true)); --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
                    $('#addtoproduct').on('click', function() {
                        var customerId = $('#customerid').val();
                        var quantity = $('#qty').val();
                        var productId = $('#productid').val();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('sale.addproduct_ajax') }}",
                            data: {
                                customerid: customerId,
                                quantity: quantity,
                                productid: productId
                            },
                            success: function(data) {
                                console.log(data);
                                $("#table-body").empty();
                                data.forEach(function(element) {
                                    var productDetails = JSON.parse(element.product_details);
                                    var row = '<tr>';
                                    row += '<td colspan="2">' + productDetails.name + '</td>';
                                    row += '<td class="text-end">' + element.qty + '</td>';
                                    row += '<td class="text-end">' + (productDetails
                                        .unit_price * element.qty).toFixed(2) + '</td>';
                                    row +=
                                        '<td class="text-end"><button class="btn btn-danger btn-sm" onclick="deleterow(' +
                                        productDetails.id + ')">delete</button></td>';
                                    row += '</tr>';
                                    $('#table-body').append(row);
                                });
                            }

                            function deleterow(productId) {
                                $.ajax({
                                        method: 'GET',
                                        url: "{{ route('sale.deleterow') }}",
                                        data:{
                                            cartid: productId,
                                        }
                                        success:function(response){
                                            console.log(response);
                                        }
                                    });
                                });
                        });
                    });
    </script>

@endsection

{{-- <tr>
    <td colspan="2">Mark</td>
    <td class="text-end">Mark</td>
    <td class="text-end">Otto</td>
  </tr> --}}
