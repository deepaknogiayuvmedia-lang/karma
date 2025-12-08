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
        @if ($message = Session::get('error'))
            <div class="alert border-0 alert-danger text-center" role="alert" id="dangerAlert">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div>
            <form action="{{ route('sale.inserteditorder') }}" class="row" method="POST">
                @csrf
                <div class="col-lg-6 p-2">
                    <div class="card">
                        <div class="card-header">
                            Add/Edit Order - fill the requirement fields
                        </div>
                        <div class="card-body row g-2">
                            <div class="col-md-6">
                                <label class="form-label required-field" for="inlineFormSelectPref">DID No.</label>
                                <select name="didno" class="form-control" id="inlineFormSelectPref" required>
                                    <option selected>Choose...</option>
                                    <option value="inbound">Inbound</option>
                                    <option value="outbound">Outbound</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label required-field">Incoming call No</label>
                                <input type="text" name="incomingcallno" class="form-control" id="inputPassword4"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputAddress" class="form-label">Mobile No.</label>
                                <input type="text" name="mobileno" class="form-control" id="inputAddress" placeholder=""
                                    pattern="[0-9]{10}" value="{{ $query->mobile }}" required />
                                <input type="hidden" name="queryid" value="{{ $query->id }}">
                            </div>
                            <div class="col-md-6">
                                <label for="inputAddress2" class="form-label">Agent Name</label>
                                <input type="text" name="agentname" class="form-control text-muted" id="inputAddress2"
                                    placeholder="" value="{{ $auth->name }}" required readonly />
                            </div>
                            <div class="col-md-6">
                                <label for="inputCity" class="form-label required-field">Customer</label>
                                <input type="text" name="customername" class="form-control" id="inputCity"
                                    value="{{ $query->name }}" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputCity" class="form-label required-field">Channel ID</label>
                                <select name="channalname" class="form-control" id="inlineFormSelectPref" required>
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
                                <select name="gender" class="form-control" id="inlineFormSelectPref" required>
                                    <option selected>Choose...</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label required-field">Blood Group</label>
                                <input name="bloodgroup" type="text" class="form-control" id="inputZip" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label required-field">Weight(kg)</label>
                                <input name="weight" type="text" class="form-control" id="inputZip" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label required-field">Age</label>
                                <input name="age" type="text" class="form-control" id="inputZip" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label required-field">Disease/Problem</label>
                                <input name="diseaseproblem" type="text" class="form-control" id="inputZip" required />
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label required-field">Height</label>
                                <input name="height" type="text" class="form-control" id="inputZip" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="inlineFormSelectPref">Disposition Lavel
                                    1</label>
                                <select name="dispositionlevelone" class="form-control" id="levelone">
                                    <option selected>Choose...</option>
                                    @foreach ($masterdata as $row)
                                        <option value="{{ $row->label }}" selected>{{ $row->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="inlineFormSelectPref">Disposition Lavel
                                    2</label>
                                <select name="dispositionleveltwo" class="form-control" id="leveltwo">
                                    <option selected>Choose...</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputZip" class="form-label">Hospital Name</label>
                                <input name="hospitalname" type="text"
                                    value="Herbanix
                                " class="form-control"
                                    id="inputZip" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required-field" for="inlineFormSelectPref">Occupation</label>
                                <select name="occupation" class="form-control" id="inlineFormSelectPref" required>
                                    <option selected>Choose...</option>
                                    <option value="business">Business</option>
                                    <option value="service">Service</option>
                                    <option value="housewife">House wife</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleFormControlTextarea1"
                                    class="form-label required-field">Comments/Remarks</label>

                                <textarea name="remarksandcomments" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-2">
                    <div class="card">
                        <div class="card-header">Billing Information</div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <label for="exampleFormControlTextarea1" class="form-label required-field">Address
                                        1</label>
                                    <textarea name="billingaddress" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label required-field">Pincode</label>
                                    <input name="billingpincode" type="text" class="form-control"
                                        value="{{ $query->address }}" id="inputPassword4" required readonly />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required-field" for="inlineFormSelectPref">Post
                                        Office</label>
                                    <select name="billingpostoffice" class="form-control" id="inlineFormSelectPref"
                                        required>
                                        @foreach ($postofficedata as $post)
                                            <option value="{{ $post->OfficeName }}">{{ $post->OfficeName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAddress" class="form-label required-field">Tehsil</label>
                                    <input name="billingtehsil" type="text" class="form-control"
                                        value="{{ $postofficesingle->District }}" id="inputAddress" placeholder=""
                                        required />
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAddress2" class="form-label required-field">City</label>
                                    <input name="billingcity" type="text" class="form-control"
                                        value="{{ $postofficesingle->District }}" id="inputAddress2" placeholder=""
                                        required />
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAddress" class="form-label required-field">State</label>
                                    <input name="billingstate" type="text" class="form-control"
                                        value="{{ $postofficesingle->StateName }}" id="inputAddress" placeholder=""
                                        required />
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Country</label>
                                    <input name="billingcountry" type="text" class="form-control" value="India"
                                        id="inputCity" />
                                </div>
                            </div>
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
                                            <th scope="col" class="text-end">Unit Price</th>
                                            <th scope="col" class="text-end">Price</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($cardlist as $cardlists)
                                            <?php $productdetails = json_decode($cardlists->product_details); ?>
                                            <?php #$totalamt+=number_format((1 / 0.016666666666667) * $productdetails->unit_price * $cardlists->qty, 2)  ?>
                                            <tr>
                                                <td colspan="2">{{ $productdetails->name }}</td>
                                                {{-- <td class="text-end">{{ $cardlists->qty }}</td> --}}
                                                <td class="text-end">
                                                    <select class="form-control" aria-label="Default select example" onchange="updateqty({{$cardlists->id}})" id="qtylabel{{$cardlists->id}}" required>
                                                        @php
                                                        for ($i = 1; $i <= 20; $i++) {
                                                            echo '<option';
                                                            if ($i == $cardlists->qty) {
                                                                echo ' selected';
                                                            }
                                                            echo ' value=' . $i . '>' . $i . '</option>';
                                                        }
                                                        @endphp
                                                    </select>
                                                </td>
                                                <td class="text-end">
                                                    {{ number_format((1 / 0.016666666666667) * $productdetails->unit_price, 2) }}
                                                </td>
                                                <td class="text-end">
                                                    {{ number_format((1 / 0.016666666666667) * $productdetails->unit_price * $cardlists->qty, 2) }}
                                                </td>
                                                <td class="text-end">
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="deleterow({{ $cardlists->id }})">
                                                        <i class="tio-delete"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
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
                                                            <select class="form-control"
                                                                aria-label="Default select example" id="qty"
                                                                required>
                                                                @php
                                                                    for ($i = 1; $i <= 20; $i++) {
                                                                        echo '<option value=' . $i . '>' . $i . '</option>';
                                                                    }
                                                                @endphp
                                                            </select>
                                                            {{-- <input type="number" id="qty" class="form-control"
                                                                id="inputPassword4" required /> --}}
                                                        </td>
                                                        <td class="text-end">
                                                            <input type="button" class="btn btn-success" value="Add"
                                                                id="addtoproduct" />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row g-2 mt-1">
                                            <div class="col-md-6">
                                                <label for="inputZip" class="form-label">Shipping Charges</label>
                                                <input name="shippingcharges" type="number" class="form-control"
                                                    id="shipping" onchange="netamount()" value="0" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputZip" class="form-label">COD Charge</label>
                                                <input name="codcharges" type="number" class="form-control"
                                                    id="cod" onchange="netamount()" value="0" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputZip" class="form-label">Discount Amount</label>
                                                <input name="discountamt" type="number" class="form-control"
                                                    id="discountamount" onchange="netamount()" value="0" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputZip" class="form-label required-field">Total Payable
                                                    amount</label>
                                                <input name="totalpayable" id="totalinput" type="number"
                                                    class="form-control" required value="0" readonly />
                                                <input type="hidden" name="hiddentotal" value="0"
                                                    id="hiddentotalvalue">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required-field"
                                                    for="inlineFormSelectPref">Payment Status</label>
                                                <select name="paymentstatus" class="form-control"
                                                    id="inlineFormSelectPref" required>
                                                    <option selected>Choose...</option>
                                                    <option value="paid">Paid</option>
                                                    <option value="unpaid">Unpaid</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required-field"
                                                    for="inlineFormSelectPref">Payment Method</label>
                                                <select name="paymentmethod" class="form-control"
                                                    id="inlineFormSelectPref" required>
                                                    <option selected>Choose...</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="online">Online</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-success">Place
                                                    order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function netamount() {
            var shipping = parseFloat(document.getElementById('shipping').value) || 0;
            var cod = parseFloat(document.getElementById('cod').value) || 0;
            var discount = parseFloat(document.getElementById('discountamount').value) || 0;
            var nettotal = parseFloat(document.getElementById('hiddentotalvalue').value) || 0;
            if (isNaN(shipping)) {
                shipping = 0;
            }
            if (isNaN(cod)) {
                cod = 0;
            }
            if (isNaN(discount)) {
                discount = 0;
            }

            var afershipping = parseFloat(nettotal) + parseFloat(shipping);
            var codaftershiiping = parseFloat(cod) + parseFloat(afershipping);

            var discountamt = parseFloat(codaftershiiping) - parseFloat(discount);
            document.getElementById('totalinput').value = discountamt.toFixed(2);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addtoproduct').on('click', function() {
                console.log("Button clicked");
                var customerId = $('#customerid').val();
                var quantity = $('#qty').val();
                var productId = $('#productid').val();
                console.log(quantity);
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
                        productid: productId,
                    },
                    success: function(data) {
                        console.log(data);
                        var totalprice = 0;
                        $("#table-body").empty();
                        data.forEach(function(element) {
                            var productDetails = JSON.parse(element.product_details);
                            totalprice += ((1 / 0.016666666666667) * productDetails
                            .unit_price).toFixed(2)  *
                            element.qty;
                            var row = '<tr>';
                            row += '<td colspan="2">' + productDetails.name + '</td>';
                            // row += '<td class="text-end">' + element.qty + '</td>';
                            row +=
                                `<td class="text-end">
                                    <select class="form-control" onchange="updateqty(${element.id})" aria-label="Default select example" id="qtylabel${element.id}" required">`;


                            for (var i = 1; i <= 20; i++) {
                                row += `<option value="${i}" ${(i == element.qty) ? 'selected' : ''}>${i}</option>`;
                            }

                            row += `</select></td>`;


                            row += '<td class="text-end"> ₹' + ((1 /
                                    0.016666666666667) * productDetails.unit_price)
                                .toFixed(2) + '</td>';
                            row += '<td class="text-end"> ₹' + ((1 /
                                    0.016666666666667) * productDetails.unit_price)
                                .toFixed(2) * element.qty + '</td>';
                            row +=
                                '<td class="text-end"><button class="btn btn-danger btn-sm" onclick="deleterow(' +
                                element.id +
                                ')"><i class="tio-delete"></i></button></td>';
                            row += '</tr>';
                            $('#table-body').append(row);
                        });
                        $('#totalinput').val(totalprice);
                        $('#hiddentotalvalue').val(totalprice);
                    }
                });
            });
        });

        function deleterow(productId) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: "{{ route('sale.deleterow') }}",
                data: {
                    cartid: productId,
                },
                success: function(data) {
                    console.log(data);
                    var totalprice = 0;
                    $("#table-body").empty();
                    data.forEach(function(element) {
                        var productDetails = JSON.parse(element.product_details);
                        totalprice += ((1 / 0.016666666666667) * productDetails
                            .unit_price).toFixed(2)  *
                            element.qty;
                        var row = '<tr>';
                        row += '<td colspan="2">' + productDetails.name + '</td>';
                        row +=
                                `<td class="text-end">
                                    <select class="form-control" onchange="updateqty(${element.id})" aria-label="Default select example" id="qtylabel${element.id}" required">`;


                            for (var i = 1; i <= 20; i++) {
                                row += `<option value="${i}" ${(i == element.qty) ? 'selected' : ''}>${i}</option>`;
                            }

                            row += `</select></td>`;
                        row += '<td class="text-end"> ₹' + ((1 / 0.016666666666667) * productDetails
                            .unit_price).toFixed(2) + '</td>';
                        row += '<td class="text-end"> ₹' + ((1 / 0.016666666666667) * productDetails
                            .unit_price).toFixed(2) * element.qty + '</td>';
                        row +=
                            '<td class="text-end"><button class="btn btn-danger btn-sm" onclick="deleterow(' +
                            element.id +
                            ')"><i class="tio-delete"></i></button></td>';
                        row += '</tr>';
                        $('#table-body').append(row);
                    });
                    $('#totalinput').val(totalprice);
                    $('#hiddentotalvalue').val(totalprice);
                }
            });
        }



        function updateqty(leadid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var valueqty = document.getElementById('qtylabel' + leadid).value;
            // alert(valueqty);
            $.ajax({
                method: 'POST',
                url: "{{ route('sale.updateqty') }}",
                data: {
                    leadid: leadid,
                    quantity: valueqty,
                },
                success: function(data) {
                    console.log(data);
                    var totalprice = 0;
                    $("#table-body").empty();
                    data.forEach(function(element) {
                        var productDetails = JSON.parse(element.product_details);
                        totalprice += ((1 / 0.016666666666667) * productDetails
                            .unit_price).toFixed(2)  *
                            element.qty;
                        var row = '<tr>';
                        row += '<td colspan="2">' + productDetails.name + '</td>';
                        row +=
                                `<td class="text-end">
                                    <select class="form-control" onchange="updateqty(${element.id})" aria-label="Default select example" id="qtylabel${element.id}" required">`;


                            for (var i = 1; i <= 20; i++) {
                                row += `<option value="${i}" ${(i == element.qty) ? 'selected' : ''}>${i}</option>`;
                            }

                            row += `</select></td>`;
                        row += '<td class="text-end"> ₹' + ((1 / 0.016666666666667) * productDetails
                            .unit_price).toFixed(2) + '</td>';
                        row += '<td class="text-end"> ₹' + ((1 / 0.016666666666667) * productDetails
                            .unit_price).toFixed(2) * element.qty + '</td>';
                        row +=
                            '<td class="text-end"><button class="btn btn-danger btn-sm" onclick="deleterow(' +
                            element.id +
                            ')"><i class="tio-delete"></i></button></td>';
                        row += '</tr>';
                        $('#table-body').append(row);
                    });
                    $('#totalinput').val(totalprice);
                    $('#hiddentotalvalue').val(totalprice);
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#levelone').change(function() {
                const selectedType = $(this).val();
                console.log(selectedType);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: `{{ route('sale.filtermasters_ajax') }}`,
                    type: 'POST',
                    data: {
                        selectedType: selectedType,
                    },
                    success: function(response) {
                        console.log("This is working", response);
                        const dropdown1 = $('#leveltwo');
                        dropdown1.empty().append($('<option selected>Choose...</option>'));
                        response.master.forEach(function(item) {
                            dropdown1.append($(
                                `<option value="${item.label}">${item.label}</option>`
                            ));
                        });
                    }
                });
            });
        });
    </script>
@endsection
