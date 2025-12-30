@php
    $userChar = auth()->user()->initials;
@endphp

<div class="main-content">

    <div class="p-3 border-bottom border-secondary border-opacity-25 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-dark d-md-none"><i class="bi bi-list"></i></button>
            <span class="fw-bold"><i class="bi bi-stars text-warning me-2"></i>MR.X chatbot </span>
        </div>
        <div>
            <span class="badge bg-secondary bg-opacity-25 text-secondary border border-secondary border-opacity-25">v1.0
                Model</span>
        </div>
    </div>


    <div class="messages-container" x-data="{
        scrollToBottom() {
            $el.scrollTo({ top: $el.scrollHeight, behavior: 'smooth' });
        }
    }" x-init="scrollToBottom()"
        x-effect="$wire.thisChat; $nextTick(() => scrollToBottom())"
        x-on:scroll-chat.window="setTimeout(() => scrollToBottom(), 100)"
        >
        @foreach ($thisChat as $msg)
            @if ($msg['role'] == 'user')
                <div class="msg-row user">
                    <div class="avatar user-avatar">{{ $userChar }}</div>
                    <div class="msg-content">
                        <div class="msg-box">
                            <p class="mb-0">{{ $msg['content'] }}</p>
                        </div>
                        <small class="text-white d-block mt-1 text-end"
                            style="font-size: 0.7rem;">{{ $msg['time'] ?? '11:11 AM' }}</small>
                    </div>
                </div>
            @elseif ($msg['role'] == 'ai')
                <div class="msg-row bot">
                    <div class="avatar bot-avatar"><i class="bi bi-robot"></i></div>
                    <div class="msg-content">
                        <div class="msg-box">
                            <p class="mb-0 text-white-75">{{ $msg['content'] }}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        {{-- loader start  --}}
        <div wire:loading wire:target="sendMessage" class="w-100">
            <div class="msg-row bot">
                <div class="avatar bot-avatar"><i class="bi bi-robot"></i></div>
                <div class="msg-content">
                    <div class="msg-box">
                        <p class="mb-0 text-white-75">
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            <span class="ms-1">Thinking...</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- loader end --}}
    </div>
    <div class="input-zone">
        <div class="d-flex justify-content-center">
            <div class="mode-selector">

            </div>
        </div>

        <div class="prompt-wrapper">
            <input type="text" class="prompt-input" placeholder="Describe what you want to create or ask..."
                name="input" wire:model="message"  wire:keydown.enter="sendMessage; $dispatch('scroll-chat')" >
            <button class="send-btn" wire:click="sendMessage"><i class="bi bi-arrow-up"></i></button>
        </div>

    </div>
</div>
