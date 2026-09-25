<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\CPU\translate('Page Not found') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          crossorigin="anonymous">
    <style>
        :root {
            --primary: {{ $web_config['primary_color'] ?? '#111827' }};
            --ink: #1F2937;
            --muted: #6B7280;
            --line: #E5E9F0;
            --bg: #F7F8FA;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background:
                radial-gradient(1200px 400px at 50% -10%, color-mix(in srgb, var(--primary) 10%, transparent), transparent),
                var(--bg);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .nf-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        .nf-card {
            width: 100%;
            max-width: 520px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(17, 24, 39, 0.06);
            padding: 40px 28px 36px;
            text-align: center;
        }

        .nf-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 72px;
            height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            background: color-mix(in srgb, var(--primary) 12%, #fff);
            color: var(--primary);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.08em;
            margin-bottom: 18px;
        }

        .nf-img {
            width: min(100%, 300px);
            height: auto;
            display: block;
            margin: 0 auto 8px;
        }

        .nf-title {
            margin: 8px 0 10px;
            font-size: clamp(24px, 4vw, 30px);
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--ink);
        }

        .nf-text {
            margin: 0 auto 8px;
            max-width: 380px;
            font-size: 15px;
            line-height: 1.6;
            color: var(--muted);
        }

        .nf-text + .nf-text {
            margin-bottom: 28px;
        }

        .nf-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .nf-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 22px;
            border-radius: 10px;
            font-size: 14.5px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease, border-color 180ms ease;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .nf-btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--primary) 25%, transparent);
        }

        .nf-btn-primary {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .nf-btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px color-mix(in srgb, var(--primary) 28%, transparent);
        }

        .nf-btn-secondary {
            background: #fff;
            color: var(--ink);
            border-color: var(--line);
        }

        .nf-btn-secondary:hover {
            border-color: #C9D0DA;
            background: #FAFBFC;
            transform: translateY(-1px);
        }

        @media (max-width: 480px) {
            .nf-card {
                padding: 32px 18px 28px;
                border-radius: 14px;
            }

            .nf-actions {
                flex-direction: column;
            }

            .nf-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="nf-wrap">
    <main class="nf-card" role="main">
        <div class="nf-badge">404</div>

        <img class="nf-img"
             src="{{ asset('assets/front-end/png/404.png') }}"
             alt="{{ \App\CPU\translate('Page Not found') }}">

        <h1 class="nf-title">{{ \App\CPU\translate('Page Not found') }}</h1>

        <p class="nf-text">
            {{ \App\CPU\translate('We are sorry the page you requested could not be found') }}
        </p>
        <p class="nf-text">
            {{ \App\CPU\translate('Please go back to the homepage') }}
        </p>

        <div class="nf-actions">
            <a class="nf-btn nf-btn-primary" href="{{ route('home') }}">
                <i class="fa fa-home" aria-hidden="true"></i>
                {{ \App\CPU\translate('HOME') }}
            </a>
            <button type="button" class="nf-btn nf-btn-secondary"
                    onclick="window.history.length > 1 ? window.history.back() : window.location.assign('{{ route('home') }}')">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                {{ \App\CPU\translate('Go Back') }}
            </button>
        </div>
    </main>
</div>
</body>
</html>
