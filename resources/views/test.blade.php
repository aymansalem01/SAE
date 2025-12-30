<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Portal - Workspace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">

</head>

<body>
    <div id="canvas-container"></div>

    <div class="ambient-light"></div>

    <!-- Radio Logic for Tabs -->
    <input type="radio" name="chat-mode" id="mode-text" class="mode-radio" checked>
    <input type="radio" name="chat-mode" id="mode-image" class="mode-radio">

    <div class="chat-layout">

        <!-- Sidebar -->
        <div class="sidebar d-none d-md-flex">
            <div class="mt-2">
                <div class="d-flex align-items-center gap-3 mb-4" style="width: 200px">
                    <img src="{{ asset('assets/ltuc.png') }}" alt="" width="100%">
                </div>
                                <div class="d-grid mb-4">
                    <button class="btn btn-primary d-flex align-items-center justify-content-center gap-2 shadow-sm" style="background-color: var(--primary-accent); border: none;">
                        <i class="bi bi-plus-lg"></i> New Chat
                    </button>
                </div>
            </div>
                @php
                    $userChar = auth()->user()->initials;
                @endphp
            <div class="border-top border-secondary border-opacity-25 pt-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-gradient-secondary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                        style="width: 36px; height: 36px; background: #475569;">
                        {{  $userChar }}
                    </div>
                    <div class="flex-grow-1" style="line-height: 1.2;">
                        <div class="fw-bold small">{{ auth()->user()->name }}</div>
                    </div>
                    <!-- Link to Login Page -->
                    <a href="{{ route('logout') }}" class="text-danger hover-white text-decoration-none" title="Logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->

        @livewire('for-test')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <script src="{{ asset('js/chat.js') }}"></script>
</body>

</html>
