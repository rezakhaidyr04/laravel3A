<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Produk')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg-1: #0f1724; --bg-2:#07122a;
            --muted:#9aa4b2; --accent1:#7c3aed; --accent2:#06b6d4;
            --card:#0b1220; --glass: rgba(255,255,255,0.04);
            --input-bg: #ffffff; --input-color: #041024;
        }
        html,body{height:100%;}
        body{font-family:Inter,system-ui,-apple-system,'Segoe UI',Roboto,Helvetica,Arial;margin:0;background:linear-gradient(180deg,var(--bg-1),var(--bg-2));color:#e6eef6;display:flex;align-items:center;justify-content:center;padding:32px}
        .wrap{width:100%;max-width:960px}
        .card{background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));border-radius:16px;padding:28px;box-shadow:0 10px 30px rgba(4,9,20,0.6);border:1px solid var(--glass);backdrop-filter: blur(6px)}
        .header{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
        h1{font-size:1.25rem;margin:0;color:#f8fbff;letter-spacing:-0.2px}
        .sub{color:var(--muted);font-size:0.95rem}
        .field{margin-bottom:14px}

        /* Inputs: white background for contrast, subtle rounded box */
        .float{position:relative}
        .float .input, .float textarea{width:100%;padding:14px 12px;border-radius:12px;border:1px solid rgba(3,6,23,0.25);background:var(--input-bg);color:var(--input-color);outline:none;font-size:0.96rem;transition:box-shadow .16s, border-color .16s, transform .08s}
        .float .input::placeholder, .float textarea::placeholder{color:#8b93a5}
        .float .input:focus, .float textarea:focus{box-shadow:0 8px 20px rgba(7,124,255,0.06);border-color:rgba(124,58,237,0.25);transform:translateY(-1px)}

        /* floating label */
        .float label{position:absolute;left:14px;top:14px;color:#64748b;pointer-events:none;padding:0 6px;background:transparent;transition:all .14s ease;border-radius:6px;font-weight:700}
        .float.filled label, .float:focus-within label{top:-10px;left:12px;font-size:0.75rem;color:#0b1220;background:linear-gradient(90deg, rgba(255,255,255,0.9), rgba(255,255,255,0.85));padding:4px 8px}

        textarea{min-height:140px;line-height:1.5}
        textarea::placeholder{color:#94a3b8}

        .two{display:grid;grid-template-columns:1fr 1fr;gap:12px}
        .actions{display:flex;justify-content:flex-end;gap:10px;margin-top:14px}

        .btn{padding:10px 16px;border-radius:12px;border:0;cursor:pointer;font-weight:700;display:inline-flex;align-items:center;gap:8px}
        .btn-primary{background:linear-gradient(90deg,var(--accent1),var(--accent2));color:#fff;box-shadow:0 6px 18px rgba(124,58,237,0.18)}
        .btn-primary:hover{transform:translateY(-2px)}
        .btn-ghost{background:transparent;color:#cfe8ff;border:1px solid rgba(255,255,255,0.06);padding:9px 14px}

        .error{color:#ffb4b4;font-size:0.92rem;margin-top:6px}
        .helper{font-size:0.85rem;color:var(--muted);margin-top:6px}
        .char-count{font-size:0.82rem;color:#64748b;text-align:right;margin-top:6px}

        @media (max-width:720px){.two{grid-template-columns:1fr}.actions{flex-direction:column-reverse;align-items:stretch}}
    </style>
    @stack('styles')
</head>
<body>
    @yield('content')

    @stack('scripts')
</body>
</html>