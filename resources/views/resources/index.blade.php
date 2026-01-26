<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Resources - Hustle Fundamentals</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}"><i class="bi bi-briefcase-fill me-2"></i>Hustle Fundamentals</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Finance Tools</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Side Hustles</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/resources') }}">Free Resources</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                </ul>
                <div class="d-flex ms-lg-3">
                    <a href="#" class="btn btn-primary btn-sm">Join Newsletter</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-primary text-white py-5 text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Free Tools & Guides</h1>
            <p class="lead">Everything you need to manage money and build income.</p>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container py-5">
        
        <!-- Filters -->
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <div class="btn-group" role="group" aria-label="Resource Filters">
                    <a href="{{ url('/resources') }}" class="btn btn-outline-primary {{ !request('category') || request('category') == 'all' ? 'active' : '' }}">All</a>
                    <a href="{{ url('/resources?category=budget') }}" class="btn btn-outline-primary {{ request('category') == 'budget' ? 'active' : '' }}">Budget</a>
                    <a href="{{ url('/resources?category=debt') }}" class="btn btn-outline-primary {{ request('category') == 'debt' ? 'active' : '' }}">Debt</a>
                    <a href="{{ url('/resources?category=investing') }}" class="btn btn-outline-primary {{ request('category') == 'investing' ? 'active' : '' }}">Investing</a>
                    <a href="{{ url('/resources?category=side_hustle') }}" class="btn btn-outline-primary {{ request('category') == 'side_hustle' ? 'active' : '' }}">Side Hustles</a>
                    <a href="{{ url('/resources?category=taxes') }}" class="btn btn-outline-primary {{ request('category') == 'taxes' ? 'active' : '' }}">Taxes</a>
                </div>
            </div>
        </div>

        <!-- Resources Grid -->
        <div class="row g-4">
            @forelse($resources as $resource)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="text-primary">
                                    @if($resource->type == 'download')
                                        <i class="bi bi-file-earmark-arrow-down fs-2"></i>
                                    @elseif($resource->type == 'guide')
                                        <i class="bi bi-journal-text fs-2"></i>
                                    @elseif($resource->type == 'calculator')
                                        <i class="bi bi-calculator fs-2"></i>
                                    @else
                                        <i class="bi bi-file-earmark fs-2"></i>
                                    @endif
                                </div>
                                <span class="badge bg-light text-dark border">{{ ucfirst(str_replace('_', ' ', $resource->category)) }}</span>
                            </div>
                            <h5 class="card-title fw-bold">{{ $resource->title }}</h5>
                            <p class="card-text text-muted small">{{ $resource->description }}</p>
                        </div>
                        <div class="card-footer bg-white border-0 pt-0 pb-4">
                            <a href="{{ $resource->url }}" class="btn btn-outline-primary w-100">
                                @if($resource->type == 'download')
                                    Download Now
                                @elseif($resource->type == 'guide')
                                    Read Guide
                                @elseif($resource->type == 'calculator')
                                    Use Calculator
                                @else
                                    View Resource
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No resources found for this category.</p>
                    <a href="{{ url('/resources') }}" class="btn btn-link">View all resources</a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Hustle Fundamentals. All rights reserved.</p>
            <small class="text-white-50">Disclaimer: Educational info, not financial advice.</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
