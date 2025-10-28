<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Insurance Renewal Reminder</title>
    <style>
        /* Mobile-friendly and basic reset */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            display: block;
            border: 0;
            outline: none;
            text-decoration: none;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            -webkit-font-smoothing: antialiased;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333333;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f4f6f8;
            padding-bottom: 40px;
            padding-top: 20px;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        }

        .header {
            padding: 20px 24px;
            text-align: left;
            background: linear-gradient(90deg, #0b74de, #0077b6);
            color: #ffffff;
        }

        .logo {
            display: inline-block;
            vertical-align: middle;
            max-height: 40px;
        }

        .hero {
            padding: 24px;
        }

        h1 {
            font-size: 20px;
            margin: 0 0 8px 0;
            color: #111827;
        }

        p {
            margin: 0 0 12px 0;
            line-height: 1.5;
            color: #555b63;
        }

        .muted {
            color: #8a8f98;
            font-size: 13px;
        }

        .details {
            background: #f8fafc;
            border: 1px solid #eef2f7;
            padding: 12px;
            border-radius: 6px;
            margin: 12px 0;
            font-size: 14px;
        }

        .cta {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #0b74de;
            color: #ffffff;
        }

        .btn-secondary {
            background-color: #eef2f7;
            color: #0b74de;
            border: 1px solid #dbeaf8;
        }

        .footer {
            padding: 16px 24px;
            font-size: 13px;
            color: #9aa0a6;
            text-align: center;
        }

        .two-col {
            width: 100%;
        }

        .small {
            font-size: 13px;
        }

        @media only screen and (max-width:480px) {
            h1 {
                font-size: 18px;
            }

            .header,
            .hero,
            .footer {
                padding-left: 16px;
                padding-right: 16px;
            }
        }
    </style>
</head>

<body>
    <center class="wrapper">
        <table class="main" role="presentation" cellpadding="0" cellspacing="0" width="600">
            <!-- Header -->
            <tr>
                <td class="header" role="presentation">
                    <table width="100%" role="presentation">
                        <tr>
                            <td style="vertical-align:middle;">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="autochanix logo"
                                    class="logo" />
                            </td>
                            <td style="text-align:right; vertical-align:middle;">
                                <span style="font-size:14px; opacity:0.95;">Policy #:
                                    <strong>{{ $insurance?->renewal?->policy_number }}</strong></span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- Body / Hero -->
            <tr>
                <td class="hero">
                    <h1>Renewal due on {{ \Carbon\Carbon::parse($insurance->expiration)->toFormattedDayDateString() }}
                    </h1>
                    <p>Hi {{ $insurance?->customer?->name ?? $insurance?->company?->name }},</p>
                    <p class="muted">This is a friendly reminder that your <strong>vehicle</strong> insurance policy is
                        set to expire on
                        <strong>{{ \Carbon\Carbon::parse($insurance->expiration)->toFormattedDayDateString() }}</strong>.
                        To avoid any coverage gaps, please renew before the expiration date.</p>

                    <div class="details" role="group" aria-label="Policy details">
                        <strong>Policy details</strong>
                        <table width="100%" cellpadding="6" cellspacing="0" role="presentation"
                            style="margin-top:8px;">
                            <tr>
                                {{-- <td style="width:50%;"><span class="small muted">Premium</span><br><strong>{{premium_amount}}</strong></td> --}}
                                <td style="width:50%;"><span class="small muted">Vehicle / Insured
                                        Item</span><br><strong>{{ $insurance->vehicle_number }}</strong></td>
                            </tr>
                            <tr>
                                <td><span
                                        class="small muted">Inception</span><br><strong>{{ \Carbon\Carbon::parse($insurance->inception)->toFormattedDayDateString() }}</strong>
                                </td>
                                <td><span
                                        class="small muted">Expiration</span><br><strong>{{ \Carbon\Carbon::parse($insurance->expiration)->toFormattedDayDateString() }}</strong>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <p style="margin-top:8px;">You can renew now with a quick, secure payment. If you'd like to update
                        your coverage or speak with an agent, we're here to help.</p>

                    <!-- Secondary info -->
                    <p style="margin-top:18px;" class="small muted">If you've already renewed, please disregard this
                        message. For questions about billing, call <strong>+233 200689684</strong> or email <a
                            href="mailto:info@shikaconnect.com">info@shikaconnect.com</a>.</p>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td class="footer">
                    <div style="max-width:540px; margin:0 auto;">
                        <p style="margin:8px 0 6px 0;"><strong>Autochanix</strong> — Accra, Dome</p>
                        <p style="margin:0 0 6px 0;">Policy #: {{ $insurance?->renewal?->policy_number }} • Customer ID:
                            {{ \Illuminate\Support\Str::uuid()->toString() }}</p>
                        <p style="margin:10px 0 0 0;">
                            <a href="#" style="color:#9aa0a6; text-decoration:underline;">Privacy policy</a>
                            &nbsp;|&nbsp;
                            <a href="#" style="color:#9aa0a6; text-decoration:underline;">Unsubscribe</a>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
