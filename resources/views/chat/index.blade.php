<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex h-96">
                    <!-- Users List -->
                    <div class="w-1/3 border-r border-gray-200 p-4">
                        <h3 class="font-semibold mb-4">Users</h3>
                        <div class="space-y-2">
                            @foreach($users as $user)
                            <a href="{{ route('chat.index', ['user_id' => $user->id]) }}" 
                               class="block p-3 rounded hover:bg-gray-100 {{ request('user_id') == $user->id ? 'bg-blue-100' : '' }}">
                                <div class="font-medium">{{ $user->name }}</div>
                                <div class="text-sm text-gray-500 capitalize">{{ $user->role }}</div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Chat Area -->
                    <div class="flex-1 flex flex-col">
                        @if(request('user_id'))
                            @php $selectedUser = $users->find(request('user_id')) @endphp
                            <!-- Chat Header -->
                            <div class="p-4 border-b border-gray-200">
                                <h4 class="font-semibold">{{ $selectedUser->name }}</h4>
                                <p class="text-sm text-gray-500 capitalize">{{ $selectedUser->role }}</p>
                            </div>

                            <!-- Messages -->
                            <div class="flex-1 p-4 overflow-y-auto" id="chatMessages">
                                @forelse($chats as $chat)
                                <div class="mb-4 {{ $chat->sender_id === auth()->id() ? 'text-right' : 'text-left' }}">
                                    <div class="inline-block max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $chat->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                                        <p>{{ $chat->message }}</p>
                                        <p class="text-xs mt-1 {{ $chat->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-500' }}">
                                            {{ $chat->created_at->format('H:i') }}
                                        </p>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-500 text-center">Belum ada pesan. Mulai percakapan!</p>
                                @endforelse
                            </div>

                            <!-- Message Input -->
                            <div class="p-4 border-t border-gray-200">
                                <form action="{{ route('chat.store') }}" method="POST" class="flex space-x-2" id="chatForm">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ request('user_id') }}">
                                    <input type="text" name="message" id="messageInput" placeholder="Ketik pesan..." required
                                           class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                           autocomplete="off">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                        Kirim
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="flex-1 flex items-center justify-center text-gray-500">
                                Pilih user untuk memulai chat
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto scroll to bottom of chat
        const chatMessages = document.getElementById('chatMessages');
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Handle form submission
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');
        
        if (chatForm) {
            chatForm.addEventListener('submit', function(e) {
                const message = messageInput.value.trim();
                if (!message) {
                    e.preventDefault();
                    alert('Pesan tidak boleh kosong!');
                    return false;
                }
                
                // Clear input after submission
                setTimeout(() => {
                    messageInput.value = '';
                }, 100);
            });

            // Handle Enter key press
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    chatForm.dispatchEvent(new Event('submit', { cancelable: true }));
                }
            });
        }

        // Simple real-time simulation (refresh every 5 seconds if in chat)
        @if(request('user_id'))
        let refreshInterval = setInterval(function() {
            if (document.visibilityState === 'visible' && !document.activeElement.matches('input[name="message"]')) {
                const currentScrollTop = chatMessages.scrollTop;
                const isAtBottom = chatMessages.scrollHeight - chatMessages.clientHeight <= currentScrollTop + 1;
                
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newMessages = doc.getElementById('chatMessages');
                        
                        if (newMessages && chatMessages.innerHTML !== newMessages.innerHTML) {
                            chatMessages.innerHTML = newMessages.innerHTML;
                            if (isAtBottom) {
                                chatMessages.scrollTop = chatMessages.scrollHeight;
                            }
                        }
                    })
                    .catch(error => console.log('Refresh error:', error));
            }
        }, 3000);

        // Clear interval when leaving page
        window.addEventListener('beforeunload', function() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }
        });
        @endif
    </script>
</x-app-layout>
