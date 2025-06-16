<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="flex h-[550px] text-sm border border-gray-200 dark:border-gray-700 rounded-xl shadow overflow-hidden bg-white dark:bg-gray-800" >
        <!-- Left: User List -->
        <div class="w-1/4 border-r border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900" >
            <div class="p-6 text-gray-700 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 text-lg font-semibold">
                Users
            </div>
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($users as $user)
                    <div wire:click="selectUsers({{ $user->id }})" 
                        class="p-3 cursor-pointer hover:bg-blue-100 transition
                        {{ $selectedUser->id === $user->id ? 'bg-blue-100 font-semibold': '' }}">
                        <div class="text-gray-800">{{ $user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                    </div>
                
                @endforeach
            </div>
        </div>
    
        <!-- Right: Chat Section -->
        <div class="w-3/4 flex flex-col">
            <!-- Header -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                <div class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $selectedUser->name }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $selectedUser->email }}</div>
            </div>
    
            <!-- Messages -->
            <div class="flex-1 p-4 overflow-y-auto space-y-3 bg-gray-50 dark:bg-gray-800">
                <!-- Message dari user saat ini (kanan) -->
                @foreach ($messages as $message)
                    <div class="flex {{ $message->sender_id === Auth()->id() ? 'justify-end' : 'justify-start'}} ">
                        <div class="max-w-xs px-4 py-2 rounded-2xl shadow {{ $message->sender_id === Auth()->id() ? 'bg-blue-600' : 'bg-gray-600'}}  text-white">
                            @if ($message->file_path)
                                @if (str_starts_with($message->file_type, 'image/'))
                                    <img src="{{ asset('storage/' . $message->file_path) }}" alt="Image" class="mb-2 rounded-md max-w-[200px]">
                                @else
                                    <a href="{{ asset('storage/' . $message->file_path) }}" target="_blank" class="underline text-sm block text-blue-200">
                                        📎 {{ $message->file_name }}
                                    </a>
                                @endif
                            @endif

                            {{ $message->message }}
                        </div>
                    </div>  
                @endforeach
            </div>
            
            <div id="typing-indicator" class="px-4 pb-1 text-xs text-gray-400 italic"></div>

            <!-- Input -->
            <form wire:submit="submit" enctype="multipart/form-data" class="p-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                
                <!-- Preview gambar -->
                @if($uploadedFile)
                    <div class="mb-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Preview:</span>
                            <button 
                                type="button" 
                                wire:click="removeFile"
                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-200"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        @if(in_array($uploadedFile->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img 
                                src="{{ $uploadedFile->temporaryUrl() }}" 
                                alt="Preview" 
                                class="max-w-xs max-h-32 rounded-lg border border-gray-200 dark:border-gray-600 object-cover"
                            />
                        @else
                            <div class="flex items-center gap-2 p-2 bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-600">
                                <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $uploadedFile->getClientOriginalName() }}</span>
                            </div>
                        @endif
                    </div>
                @endif
                
                <!-- Input area -->
                <div class="flex items-center gap-2">
                    <!-- File upload button -->
                    <label for="file-upload" class="cursor-pointer p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200 border border-gray-300 dark:border-gray-600">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                    </label>

                    <!-- Hidden file input -->
                    <input 
                        id="file-upload"
                        wire:model="uploadedFile"
                        type="file"
                        accept="image/*,.pdf,.doc,.docx,.txt"
                        class="hidden" 
                    />
                    
                    <!-- Text input -->
                    <input 
                        wire:model.live="newMessage"
                        type="text"
                        class="flex-1 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 placeholder-gray-500 dark:placeholder-gray-400 transition-colors duration-200"
                        placeholder="Type your message..." 
                    />

                    <!-- Send button -->
                    <button 
                        type="submit"
                        class="fi-btn fi-btn-color-primary fi-btn-size-md inline-flex items-center justify-center gap-1 rounded-lg border border-transparent bg-primary-600 dark:bg-primary-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 dark:hover:bg-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="!$wire.newMessage && !$wire.uploadedFile"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>

      <style>
        /* Custom scrollbar for chat messages */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
        
        .dark .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #4b5563;
        }
        
        .dark .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }
    </style>

</x-filament-panels::page>
<script>
    document.addEventListener('livewire:initialized', ()=> {
        Livewire.on('userTyping', (event) => {
            window.Echo.private(`chat.${event.selectedUserID}`).whisper("typing", {
                userID: event.userID,
                userName: event.userName
            });
        });

        window.Echo.private(`chat.{{ $loginID }}`).listenForWhisper('typing', (event) => {
            var t = document.getElementById("typing-indicator");
            t.innerHTML = `${event.userName} is typing....`

            setTimeout(() => {
                t.innerHTML = ''
            }, 2000)
        })

    });
</script>
