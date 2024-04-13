<div>
    <div class="flex justify-start gap-2 items-center">
        <button wire:click="like"
            class="fill-red-600 col-span-1 flex justify-between items-center rounded-lg p-2 duration-300 bg-white hover:border-red-600 focus:fill-white focus:bg-red-500 border border-slate-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill=" {{$isLiked ? "red" : "white"}} " viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </button>
        
        <p class="text-2xl font-bold text-gray-600">
            {{ $likes }} Likes
        </p>
    </div>
</div>
