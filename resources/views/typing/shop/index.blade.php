<x-typing-app :role="auth()->user()->role" :title="'ร้านค้าแลกของรางวัล - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    <div class="space-y-10 pb-12">
        
        <!-- Aurora & Glass Header -->
        <div class="relative overflow-hidden bg-white border border-white/40 rounded-[2.5rem] p-8 md:p-10 shadow-2xl group transition-all duration-500 hover:shadow-primary-500/10">
            <!-- Aurora Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-white via-primary-50/30 to-indigo-50/20 opacity-80"></div>
            <div class="absolute top-[-30%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-br from-primary-300/10 via-indigo-300/10 to-purple-200/10 rounded-full blur-[80px] animate-pulse-slow pointer-events-none mix-blend-multiply"></div>
            
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-primary-500 to-indigo-600 text-white flex items-center justify-center shadow-2xl transform group-hover:rotate-6 transition-all duration-500">
                        <i class="fas fa-store text-4xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight mb-2">ร้านค้าแลกรางวัล</h1>
                        <p class="text-gray-500 font-medium text-lg flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-primary-500"></span>
                            ใช้ผลการเรียนแลกไอเทมตกแต่งโปรไฟล์สุดพิเศษ
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-4 p-2 pl-6 bg-white border border-gray-100 rounded-[2rem] shadow-sm">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">คะแนนปัจจุบัน</p>
                            <p class="text-2xl font-black text-primary-600">{{ number_format($user->points) }}</p>
                        </div>
                        <div class="w-14 h-14 rounded-full bg-amber-400 text-white flex items-center justify-center shadow-lg shadow-amber-400/20 animate-bounce-slow">
                            <i class="fas fa-coins text-2xl"></i>
                        </div>
                    </div>
                    <a href="{{ route('typing.shop.my-rewards') }}" 
                        class="group/btn flex items-center gap-3 px-8 py-4 bg-gray-800 text-white font-black rounded-2xl hover:bg-black hover:shadow-2xl hover:-translate-y-1 transition-all overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-1000"></div>
                        <i class="fas fa-box-open transition-transform group-hover/btn:rotate-12"></i>
                        รางวัลที่ฉ้นมี
                    </a>
                </div>
            </div>
        </div>

        <!-- Categories & Filter Bento -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
            @php
                $categories = [
                    ['type' => 'all', 'label' => 'ทั้งหมด', 'icon' => 'fa-th-large', 'color' => 'from-primary-400 to-primary-600', 'ring' => 'ring-primary-500', 'bg' => 'bg-primary-50', 'count' => $stats['total_items']],
                    ['type' => 'avatar_frame', 'label' => 'กรอบรูป', 'icon' => 'fa-circle-user', 'color' => 'from-purple-400 to-purple-600', 'ring' => 'ring-purple-500', 'bg' => 'bg-purple-50', 'count' => $stats['avatar_frames']],
                    ['type' => 'theme', 'label' => 'ธีม', 'icon' => 'fa-palette', 'color' => 'from-pink-400 to-pink-600', 'ring' => 'ring-pink-500', 'bg' => 'bg-pink-50', 'count' => $stats['themes']],
                    ['type' => 'title', 'label' => 'ตำแหน่ง', 'icon' => 'fa-crown', 'color' => 'from-amber-400 to-amber-600', 'ring' => 'ring-amber-500', 'bg' => 'bg-amber-50', 'count' => $stats['titles']],
                    ['type' => 'name_color', 'label' => 'สีชื่อ', 'icon' => 'fa-font', 'color' => 'from-indigo-400 to-indigo-600', 'ring' => 'ring-indigo-500', 'bg' => 'bg-indigo-50', 'count' => $stats['name_colors']],
                    ['type' => 'profile_bg', 'label' => 'บัตร', 'icon' => 'fa-id-card', 'color' => 'from-emerald-400 to-emerald-600', 'ring' => 'ring-emerald-500', 'bg' => 'bg-emerald-50', 'count' => $stats['profile_bgs']],
                ];
            @endphp

            @foreach($categories as $cat)
                <a href="{{ $cat['type'] === 'all' ? route('typing.shop.index') : route('typing.shop.index', ['type' => $cat['type']]) }}" 
                    class="group relative overflow-hidden bg-white rounded-3xl p-5 border border-gray-100 shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1 
                    {{ $type === $cat['type'] ? 'ring-2 '.$cat['ring'].' '.$cat['bg'] : '' }}">
                    <div class="relative z-10">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $cat['color'] }} text-white flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                            <i class="fas {{ $cat['icon'] }}"></i>
                        </div>
                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">{{ $cat['label'] }}</p>
                        <p class="text-xl font-black text-gray-800">{{ $cat['count'] }}</p>
                    </div>
                </a>
            @endforeach

            <a href="{{ route('typing.shop.my-rewards') }}" class="group relative overflow-hidden bg-gray-900 rounded-3xl p-5 shadow-xl transition-all duration-300 hover:shadow-primary-500/20 hover:-translate-y-1">
                <div class="relative z-10">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-gray-700 to-gray-800 text-white flex items-center justify-center mb-4 border border-gray-600">
                        <i class="fas fa-box"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">Items</p>
                    <p class="text-xl font-black text-white">{{ $stats['owned'] }} <span class="text-[10px] text-gray-500">OWNED</span></p>
                </div>
            </a>
        </div>
        
        <!-- Items Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($items as $item)
                @php
                    $isOwned = in_array($item->id, $ownedItemIds);
                    $canAfford = $user->points >= $item->price;
                    $rarityClass = match($item->rarity) {
                        'legendary' => 'border-amber-400 shadow-amber-500/10 from-amber-50 to-orange-50',
                        'epic' => 'border-purple-400 shadow-purple-500/10 from-purple-50 to-indigo-50',
                        'rare' => 'border-blue-400 shadow-blue-500/10 from-blue-50 to-cyan-50',
                        default => 'border-gray-100 shadow-gray-500/5 from-gray-50 to-white',
                    };
                @endphp
                
                <div class="group relative bg-white rounded-[2.5rem] border transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 overflow-hidden flex flex-col {{ $rarityClass }} {{ $isOwned ? 'ring-2 ring-emerald-500' : '' }}">
                    
                    <!-- Top Ribbon & Rarity -->
                    <div class="absolute top-5 left-5 z-20">
                        <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.2em] {{ $item->rarity_badge }} shadow-sm">
                            {{ $item->rarity_name }}
                        </span>
                    </div>

                    @if($isOwned)
                        <div class="absolute top-5 right-5 z-20">
                            <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-lg transform rotate-12">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Item Display Area -->
                    <div class="relative h-60 flex items-center justify-center p-8 bg-gradient-to-b from-white/0 to-white/60">
                        @if($item->rarity === 'legendary')
                            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-from),transparent_70%)] from-amber-200/20 blur-2xl animate-pulse"></div>
                        @endif

                        <div class="relative z-10 transition-transform duration-700 group-hover:scale-110">
                            @if($item->type === 'avatar_frame')
                                <div class="relative">
                                    <div class="w-32 h-32 rounded-full p-1.5 bg-gradient-to-br {{ $item->rarity_color }} shadow-2xl animate-spin-slow">
                                        <div class="w-full h-full rounded-full bg-white flex items-center justify-center overflow-hidden">
                                            <i class="fas fa-user-circle text-6xl text-gray-200"></i>
                                        </div>
                                    </div>
                                    @if($item->data && isset($item->data['icon']))
                                        <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-white rounded-2xl flex items-center justify-center shadow-xl border border-gray-100 animate-bounce-slow">
                                            <span class="text-2xl">{{ $item->data['icon'] }}</span>
                                        </div>
                                    @endif
                                </div>
                            @elseif($item->type === 'theme')
                                <div class="w-48 h-32 rounded-[2rem] bg-gradient-to-br {{ $item->data['gradient'] ?? 'from-gray-100 to-gray-200' }} shadow-2xl flex flex-col items-center justify-center gap-3 transform rotate-3">
                                    <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white border border-white/30">
                                        <i class="fas fa-palette text-2xl"></i>
                                    </div>
                                    <span class="text-[10px] font-black text-white/80 uppercase tracking-widest">Profile Theme</span>
                                </div>
                            @elseif($item->type === 'title')
                                <div class="text-center">
                                    <div class="text-5xl mb-4 animate-bounce-slow">{{ $item->data['emoji'] ?? '🏆' }}</div>
                                    <div class="px-6 py-2.5 rounded-[1.5rem] bg-gradient-to-r {{ $item->rarity_color }} text-white font-black text-sm shadow-xl tracking-tight">
                                        {{ $item->name }}
                                    </div>
                                </div>
                            @elseif($item->type === 'name_color')
                                <div class="relative p-6 rounded-[2rem] bg-white border border-gray-100 shadow-inner overflow-hidden group/name">
                                    <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b {{ $item->rarity_color }}"></div>
                                    <span class="text-2xl font-black {{ $item->data['class'] ?? 'text-gray-800' }} transition-all duration-500">
                                        {{ explode(' ', $user->name)[0] }}
                                    </span>
                                    <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest mt-2">Display Name Example</p>
                                </div>
                            @elseif($item->type === 'profile_bg')
                                <div class="w-48 h-32 rounded-[2rem] {{ $item->data['class'] ?? 'bg-white' }} border border-gray-100 shadow-2xl overflow-hidden p-4 relative group/card">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 rounded-xl bg-gray-200/50"></div>
                                        <div class="space-y-1.5 flex-1">
                                            <div class="h-2 w-full bg-gray-200/50 rounded-full"></div>
                                            <div class="h-2 w-2/3 bg-gray-200/50 rounded-full"></div>
                                        </div>
                                    </div>
                                    <div class="space-y-1.5">
                                        <div class="h-1.5 w-full bg-gray-100/30 rounded-full"></div>
                                        <div class="h-1.5 w-full bg-gray-100/30 rounded-full"></div>
                                    </div>
                                    <div class="absolute bottom-4 right-4 text-[10px] font-black text-gray-400 {{ $item->rarity === 'legendary' ? 'text-amber-500' : '' }}">CARD STYLE</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Content Area -->
                    <div class="p-8 pt-0 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                    <i class="fas {{ $item->type_icon }} mr-1 text-primary-500"></i>
                                    {{ $item->type_name }}
                                </span>
                            </div>
                            <h3 class="text-xl font-black text-gray-800 leading-tight mb-2 group-hover:text-primary-600 transition-colors">
                                {{ $item->name }}
                            </h3>
                            <p class="text-sm text-gray-500 font-medium line-clamp-2 leading-relaxed">
                                {{ $item->description ?: 'ไอเทมตกแต่งโปรไฟล์ระดับ '.$item->rarity_name.' เพิ่มความโดดเด่นไม่เหมือนใคร' }}
                            </p>
                        </div>
                        
                        <div class="mt-8 space-y-4">
                            <!-- Price & Action -->
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Price</span>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-coins text-amber-500"></i>
                                        <span class="text-2xl font-black {{ $canAfford ? 'text-gray-800' : 'text-red-500' }}">
                                            {{ number_format($item->price) }}
                                        </span>
                                    </div>
                                </div>
                                
                                @if($isOwned)
                                    <a href="{{ route('typing.shop.my-rewards') }}" class="px-6 py-3 bg-emerald-50 text-emerald-600 font-black rounded-2xl border border-emerald-100 hover:bg-emerald-100 transition-all flex items-center gap-2">
                                        <i class="fas fa-box-open"></i>
                                        Owned
                                    </a>
                                @elseif(!$item->isInStock())
                                    <div class="px-6 py-3 bg-gray-100 text-gray-400 font-black rounded-2xl cursor-not-allowed">
                                        Out of stock
                                    </div>
                                @elseif(!$canAfford)
                                    <div class="px-6 py-3 bg-red-50 text-red-400 font-black rounded-2xl border border-red-100 cursor-not-allowed group/lock relative">
                                        <i class="fas fa-lock"></i>
                                        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-1 bg-gray-900 text-white text-[10px] rounded opacity-0 group-hover/lock:opacity-100 transition-opacity whitespace-nowrap">คะแนนไม่พอ</div>
                                    </div>
                                @else
                                    <form action="{{ route('typing.shop.purchase', $item->id) }}" method="POST" 
                                          onsubmit="return confirm('ยืนยันแลก {{ $item->name }} ด้วยคะแนน {{ number_format($item->price) }}?')">
                                        @csrf
                                        <button type="submit" class="group/buy flex items-center gap-3 px-8 py-3.5 bg-primary-500 text-white font-black rounded-2xl hover:bg-primary-600 hover:shadow-xl hover:-translate-y-1 transition-all">
                                            <i class="fas fa-shopping-cart text-sm"></i>
                                            Buy
                                        </button>
                                    </form>
                                @endif
                            </div>

                            @if($item->stock !== null && !$isOwned)
                                <div class="w-full bg-gray-50 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-primary-400 h-full rounded-full" style="width: {{ min(100, ($item->stock / 20) * 100) }}%"></div>
                                </div>
                                <p class="text-[9px] font-black text-center text-gray-400 uppercase tracking-widest">
                                    Only {{ $item->stock }} items remaining
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="w-32 h-32 bg-gray-50 rounded-[3rem] flex items-center justify-center mx-auto mb-6 text-gray-300 transform -rotate-12">
                        <i class="fas fa-store-slash text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-400 uppercase tracking-widest">สินค้านี้ยังไม่มีในสต็อก</h3>
                    <a href="{{ route('typing.shop.index') }}" class="inline-flex items-center gap-2 mt-6 text-primary-500 font-black hover:gap-4 transition-all">
                        <i class="fas fa-arrow-left"></i>
                        BACK TO ALL ITEMS
                    </a>
                </div>
            @endforelse
        </div>
        
        <!-- Points Guide Bento -->
        <div class="bg-gray-900 rounded-[3rem] p-8 md:p-12 shadow-2xl relative overflow-hidden text-white">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary-500/20 rounded-full blur-[100px]"></div>
            
            <div class="relative z-10">
                <div class="max-w-xl mb-12">
                    <h3 class="text-3xl font-black tracking-tight mb-4">
                        <i class="fas fa-sparkles text-amber-400 mr-3"></i>
                        HOW TO EARN POINTS?
                    </h3>
                    <p class="text-gray-400 font-medium">คะแนนได้มาจากการตั้งใจเรียนและฝึกฝนการพิมพ์ ยิ่งพิมพ์แม่น ยิ่งพิมพ์ไว ยิ่งได้คะแนนเยอะ!</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach([
                        ['icon' => 'fa-keyboard', 'title' => 'ตั้งใจฝึกซ้อม', 'desc' => 'ส่งงานพิมพ์ตามที่ได้รับมอบหมาย', 'color' => 'bg-indigo-500/20 text-indigo-400'],
                        ['icon' => 'fa-gamepad', 'title' => 'เจ้าสังเวียน 1v1', 'desc' => 'ท้าแข่งกับเพื่อนและเอาชนะให้ได้', 'color' => 'bg-amber-500/20 text-amber-400'],
                        ['icon' => 'fa-fire', 'title' => 'รักษาสถิติรายวัน', 'desc' => 'ขยันพิมพ์ทุกวันรับโบนัสสะสม', 'color' => 'bg-rose-500/20 text-rose-400'],
                    ] as $guide)
                        <div class="group flex gap-6 p-6 rounded-[2rem] bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-500">
                            <div class="w-14 h-14 rounded-2xl {{ $guide['color'] }} flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform shrink-0">
                                <i class="fas {{ $guide['icon'] }} text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-lg mb-1">{{ $guide['title'] }}</h4>
                                <p class="text-sm text-gray-500 font-medium">{{ $guide['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-spin-slow { animation: spin 12s linear infinite; }
        .animate-bounce-slow { animation: bounce 3s infinite; }
        .animate-pulse-slow { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    </style>
</x-typing-app>
