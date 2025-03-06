<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $filename }} - Plain Log View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .log-content {
            white-space: pre-wrap;
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            line-height: 1.5;
            background-color: #fff;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            overflow-x: auto;
        }
        .search-form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4 text-primary">{{ $filename }} - System Logs</h1>

        <!-- Search Form -->
        <form action="{{ route('logs.show') }}" method="GET" class="search-form d-flex">
            <input type="text" name="search" class="form-control me-2 border-primary" placeholder="Search logs..."
                value="{{ request()->input('search', '') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Log Content -->
        <div class="log-content">
            {{ $logContent }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add enter key support for the search form
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        this.form.submit();
                    }
                });
            }
        });
    </script>
</body>
</html>