<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'BiblioTEK')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
            color: #1e293b;
        }

        header {
            background: rgba(15, 23, 42, 0.95);
            color: white;
            padding: 18px 28px;
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 0.3px;
        }

        .nav-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 10px;
            transition: 0.2s ease;
            font-weight: 600;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.12);
        }

        main {
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 20px 30px;
        }

        .panel {
            background: rgba(255,255,255,0.88);
            border: 1px solid rgba(255,255,255,0.7);
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08);
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 12px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary { background: #2563eb; color: white; }
        .btn-warning { background: #f59e0b; color: white; }
        .btn-danger { background: #dc2626; color: white; }
        .btn-secondary { background: #64748b; color: white; }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
            background: white;
            border-radius: 16px;
            overflow: hidden;
        }

        th, td {
            border-bottom: 1px solid #e5e7eb;
            padding: 12px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f8fafc;
        }

        input[type="text"], select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            margin-top: 6px;
            margin-bottom: 14px;
            box-sizing: border-box;
            background: white;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .inline {
            display: inline;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .checkbox-list label {
            display: inline-block;
            margin-right: 12px;
            margin-bottom: 8px;
        }

        .pagination {
            margin-top: 20px;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 24px;
            align-items: stretch;
        }

        .hero-left {
            padding: 8px 0;
        }

        .badge {
            display: inline-block;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .hero h1 {
            font-size: 48px;
            line-height: 1.05;
            margin: 0 0 14px;
        }

        .hero p {
            font-size: 17px;
            line-height: 1.7;
            color: #475569;
            margin-bottom: 22px;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff, #eff6ff);
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.08);
        }

        .stat-label {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 30px;
            font-weight: 800;
            color: #0f172a;
        }

        .section-title {
            font-size: 28px;
            margin: 34px 0 16px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .card {
            background: rgba(255,255,255,0.92);
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.06);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .card p {
            color: #475569;
            line-height: 1.6;
        }

        @media (max-width: 900px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
            }

            .hero h1 {
                font-size: 36px;
            }
        }

        @media (max-width: 600px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="nav">
        <div class="brand">
            <a href="{{ route('home') }}" style="color:white; text-decoration:none;">BiblioTEK</a>
        </div>

        <div class="nav-links">
            <a href="{{ route('home') }}">Accueil</a>
            <a href="{{ route('livres.index') }}">Livres</a>
            <a href="{{ route('livres.create') }}">Ajouter un livre</a>
            <a href="{{ route('emprunts.create') }}">Emprunter</a>
        </div>
    </div>
</header>

<main>
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <strong>Erreur :</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>
