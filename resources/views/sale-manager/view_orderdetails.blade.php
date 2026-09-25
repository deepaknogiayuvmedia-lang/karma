@extends('layouts.back-end.sale_app')
@section('title', \App\CPU\translate('Product Query'))
@push('css_or_js')
@endpush

@section('content')
    <style>
        .required-field::before {
            content: "* ";
            11 color: red;
        }

        /* Style for the message box */
        .message-box {
            background-color: #ececec;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            border-radius: 0px 0px 0px 0px;
            padding: 10px;
            padding-bottom: 2px !important;
            width: 98%;
            margin: 1px;
            margin-top: 5px !important;
            margin-left: 5px !important;
            margin-bottom: 5px !important;
        }

        .message-boxnew {
            /* background-color: #71869d; */
            border-top: 1px solid black;
            padding: 10px;
            padding-bottom: 2px !important;
            width: 100%;
            margin-bottom: 0px !important;
        }

        .message-text {
            color: #000000;
            font-size: 14px;
        }

        .vertical-hr {
            border-left: 1px solid #000000;
            height: 20px;
            margin: 0;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Order Details
                    </div>
                    <div class="card-body g-2">
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <p class="bg-secondary p-2 fw-bold text-white text-start">Customer Details
                                            </p>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>SUKHAMOY MUKHERJEE</td>
                                            </tr>
                                            <tr>
                                                <td>SUKHAMOY MUKHERJEE</td>
                                            </tr>
                                            <tr>
                                                <td>SUKHAMOY MUKHERJEE</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <p class="bg-secondary p-2 fw-bold text-white text-start">Payment Address
                                            </p>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>SUKHAMOY MUKHERJEE</td>
                                            </tr>
                                            <tr>
                                                <td>SUKHAMOY MUKHERJEE</td>
                                            </tr>
                                            <tr>
                                                <td>SUKHAMOY MUKHERJEE</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <div class="d-flex justify-content-between bg-secondary">
                                                <p class="m-2 p-1 fw-bold text-white text-start">Shipping
                                                    Adress</p>
                                                <button class="btn btn-success btn-sm m-2 p-1">Edit Address</button>
                                            </div>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>SUKHAMOY MUKHERJEE</td>
                                            </tr>
                                            <tr>
                                                <td>SUKHAMOY MUKHERJEE</td>
                                            </tr>
                                            <tr>
                                                <td>SUKHAMOY MUKHERJEE</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>Product</th>
                                            <th>Model</th>
                                            <th>Quantity</th>
                                            <th>Selling Price</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Sugo Plus Suger Capsule</td>
                                                <td>HBNXSG001</td>
                                                <td>2</td>
                                                <td class="text-end">Rs.2,499.00</td>
                                                <td class="text-end">Rs.4,998.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">Sub-Total</td>
                                                <td class="text-end">0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">Free Shipping</td>
                                                <td class="text-end">0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">Discount</td>
                                                <td class="text-end">0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">Total</td>
                                                <td class="text-end">0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Add Order History
                    </div>
                    <form id="historyform" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="bg-white border border-secondary" id="mainchatbox"
                                style="height: 300px; overflow-y:scroll;">
                                {{-- Row appends here --}}
                                @foreach ($followupdata as $msg)
                                    <div class="message-box">
                                        <p class="message-text">{{ $msg->message }}</p>
                                        <div class="pt-0 pe-3 ps-3 pb-2 mt-0  mb-3 message-boxnew">
                                            <div class="row">
                                                <div class="col text-black">{{ substr($msg->authfullname, 0, 20) }} </div>
                                                <hr class="vertical-hr">
                                                <div class="col  text-black">{{ $msg->orderstatus }}</div>
                                                <hr class="vertical-hr">
                                                <div class="col  text-black">{{ $msg->created_at->format('d/M/y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Order Status</td>
                                            <td>
                                                <select name="orderstatus" class="form-control" id="orderstatusselect"
                                                    required>
                                                    <option selected>Choose...</option>
                                                    <option value="business">Business</option>
                                                    <option value="service">Service</option>
                                                    <option value="housewife">House wife</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <input type="hidden" name="orderid" value="{{ $orderid }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Override</td>
                                            <td>
                                                <div class="form-check form-check-reverse">
                                                    <input name="override" class="form-check-input" type="checkbox"
                                                        id="reverseCheck1">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Notify Customer</td>
                                            <td>
                                                <div class="form-check form-check-reverse">
                                                    <input name="notifycustomer" class="form-check-input" type="checkbox"
                                                        id="reverseCheck2">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Comment</td>
                                            <td>
                                                <textarea name="remarksandcomments" class="form-control" id="comments" rows="4" required></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Add History</button>
                            </div>
                            <p id="msg" class="p-2 mt-3 text-success text-center fw-bold"></p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mt-4">
                    <div class="card-header">
                        Histories
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <p class="m-2 p-1 fw-bold text-dark">Order History</p>
                            <div class="col-md-12">
                                <div class="row mt-2">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>Date Added</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Customer Notified</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p class="m-2 p-1 fw-bold text-dark">Disposition Order History</p>
                            <div class="col-md-12">
                                <div class=" mt-2">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>Date Added</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Fullop Called</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#historyform').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('sale.create_followup') }}',
                    data: formData,
                    success: function(response) {
                        var messages = response.data;
                        $('#msg').html(response.msg);
                        $('#mainchatbox').empty();
                        messages.forEach(function(msg) {
                            var date = new Date(msg.created_at);
                            var formattedDate = date.toLocaleDateString();
                            var div = `
                                <div class="message-box">
                                    <p class="message-text">${msg.message}</p>
                                    <div class="pt-0 pe-3 ps-3 pb-2 mt-0 mb-3 message-boxnew">
                                        <div class="row">
                                            <div class="col text-black">${msg.authfullname}</div>
                                            <hr class="vertical-hr">
                                            <div class="col text-black">${msg.orderstatus}</div>
                                            <hr class="vertical-hr">
                                            <div class="col text-black">${formattedDate}</div>
                                        </div>
                                    </div>
                                </div>`;
                            $('#mainchatbox').append(div);
                        });
                        console.log(response);

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert(
                            'An error occurred while processing your request. Please try again.'
                        );
                    }
                });
            });
        });
    </script>
@endsection

