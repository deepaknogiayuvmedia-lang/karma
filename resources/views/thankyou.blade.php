@extends('layouts.front-end.app')
@section('content')
        @push('title')
            <title>Thank you for Visit..Herbanix</title>
        @endpush
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }

            .thank-you-container {
                text-align: center;
                margin: 100px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 400px;
            }

            .logo {
                max-width: 100px;
                margin-bottom: 20px;
            }

            .home-button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4caf50;
                color: #fff;
                text-decoration: none;
                border-radius: 4px;
                transition: background-color 0.3s;
            }

            .home-button:hover {
                background-color: #45a049;
            }
        </style>
        <div class="thank-you-container">
            <img src="https://herbanix.co/storage/app/public/company/2023-12-20-658269db7badc.png" alt="Logo" class="logo" />
            <p>Thank you for your support!</p>
            <a href="https://herbanix.co/" class="home-button">Find more Product</a>
        </div>
@endsection
