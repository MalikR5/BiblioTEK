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

        :root {
            --bg: #f4f7fb;
            --panel: rgba(255, 255, 255, 0.92);
            --panel-strong: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --warning: #f59e0b;
            --danger: #dc2626;
            --success-bg: #dcfce7;
            --success-text: #166534;
            --error-bg: #fee2e2;
            --error-text: #991b1b;
            --shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            --radius: 22px;
        }

        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background:
                radial-gradient(circle at top left, #dbeafe 0%, transparent 28%),
                radial-gradient(circle at top right, #e9d5ff 0%, transparent 22%),
                linear-gradient(180deg, #f8fbff 0%, #eef2ff 100%);
            color: var(--text);
        }

        header {
            position: sticky;
            top: 0;
            z-index: 20;
            background: rgba(15, 23, 42, 0.88);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .nav {
            max-width: 1220px;
            margin: 0 auto;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }

        .brand a {
            color: white;
            text-decoration: none;
            font-weight: 900;
            font-size: 24px;
            letter-spacing: 0.4px;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.12);
            transform: translateY(-1px);
        }

        main {
            max-width: 1220px;
            margin: 30px auto 50px;
            padding: 0 18px;
        }

        .panel {
            background: var(--panel);
            border: 1px solid rgba(255,255,255,0.7);
            border-radius: var(--radius);
            padding: 28px;
            box-shadow: var(--shadow);
        }

        .page-header {
            margin-bottom: 18px;
        }

        .page-header h1 {
            margin: 0 0 6px;
            font-size: 34px;
            line-height: 1.1;
        }

        .page-header p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            border-radius: 14px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 800;
            transition: 0.2s ease;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.06);
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }

        .btn-warning { background: var(--warning); color: white; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-secondary { background: var(--secondary); color: white; }

        .alert-success,
        .alert-error {
            border-radius: 16px;
            padding: 15px 18px;
            margin-bottom: 18px;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
        }

        .alert-success {
            background: var(--success-bg);
            color: var(--success-text);
        }

        .alert-error {
            background: var(--error-bg);
            color: var(--error-text);
        }

        .alert-error ul {
            margin: 8px 0 0 18px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .top-bar h1 {
            margin: 0 0 6px;
            font-size: 32px;
        }

        .top-bar p {
            margin: 0;
            color: var(--muted);
        }

        form {
            margin: 0;
        }

        label {
            display: block;
            font-weight: 700;
            margin-bottom: 6px;
            color: #334155;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            background: white;
            font-size: 14px;
            color: var(--text);
            margin-bottom: 16px;
            transition: 0.2s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #93c5fd;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .checkbox-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px 14px;
            margin-bottom: 18px;
        }

        .checkbox-list label {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 10px 12px;
            border-radius: 12px;
            margin-bottom: 0;
            font-weight: 600;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .inline {
            display: inline;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 18px;
            background: var(--panel-strong);
            border: 1px solid var(--line);
            border-radius: 18px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            vertical-align: top;
            border-bottom: 1px solid #edf2f7;
        }

        th {
            background: #f8fafc;
            color: #334155;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fbff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            background: #dbeafe;
            color: #1d4ed8;
        }

        .muted {
            color: var(--muted);
        }

        .hero {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 24px;
            align-items: stretch;
        }

        .hero h1 {
            margin: 0 0 12px;
            font-size: 48px;
            line-height: 1.04;
        }

        .hero p {
            margin: 0 0 22px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.7;
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
            border: 1px solid #dbeafe;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.08);
        }

        .stat-label {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 30px;
            font-weight: 900;
        }

        .section-title {
            margin: 34px 0 16px;
            font-size: 28px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .card {
            background: rgba(255,255,255,0.95);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.05);
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 20px;
        }

        .card p {
            margin: 0 0 16px;
            color: var(--muted);
            line-height: 1.6;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 18px;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 16px;
            border-radius: 16px;
        }

        .info-box strong {
            display: block;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .pagination {
            margin-top: 22px;
        }

        .pagination nav {
            display: flex;
            justify-content: center;
        }

        @media (max-width: 920px) {
            .hero,
            .cards,
            .info-grid {
                grid-template-columns: 1fr;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
            }

            .hero h1 {
                font-size: 38px;
            }
        }

        @media (max-width: 640px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .top-bar h1,
            .page-header h1 {
                font-size: 28px;
            }

            .hero h1 {
                font-size: 30px;
            }

            .panel {
                padding: 20px;
            }

            th, td {
                font-size: 14px;

                .custom-pagination {
                    margin-top: 24px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    gap: 10px;
                    flex-wrap: wrap;
                }

                .custom-pagination a,
                .custom-pagination span {
                    padding: 10px 14px;
                    border-radius: 12px;
                    border: 1px solid #dbe3ee;
                    background: white;
                    color: #0f172a;
                    text-decoration: none;
                    font-weight: 700;
                    box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
                }

                .custom-pagination a:hover {
                    background: #eff6ff;
                    border-color: #bfdbfe;
                }

                .custom-pagination .active-page {
                    background: #2563eb;
                    color: white;
                    border-color: #2563eb;
                }

                .custom-pagination .disabled {
                    opacity: 0.5;
                    cursor: not-allowed;
                }
            }
        }
    </style>
</head>
<body>
<header>
    <div class="nav">
        <div class="brand">
            <a href="{{ route('home') }}">BiblioTEK</a>
        </div>

        <<div class="nav-links">
            <a href="{{ route('home') }}">Accueil</a>

            @auth
                <a href="{{ route('livres.index') }}">Livres</a>
                <a href="{{ route('auteurs.index') }}">Auteurs</a>
                <a href="{{ route('usagers.index') }}">Usagers</a>
                <a href="{{ route('livres.create') }}">Ajouter un livre</a>
                <a href="{{ route('emprunts.create') }}">Emprunter</a>
                <a href="{{ route('profil.index') }}">Mon profil</a>
                <a href="{{ route('retours.index') }}">Retours</a>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}">Connexion</a>
            @endauth
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
