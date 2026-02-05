<x-typing-app :role="auth()->user()->role" :title="'รางวัลของฉัน - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    <div class="space-y-10 pb-12">

        <!-- Back Button & Premium Header -->
        <div class="space-y-6">
            <a href="{{ route('typing.shop.index') }}"
                class="group inline-flex items-center gap-2 px-6 py-2.5 bg-white border border-gray-100 rounded-2xl text-sm font-black text-gray-500 hover:text-primary-600 hover:shadow-xl hover:-translate-x-1 transition-all">
                <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                กลับไปที่ร้านค้า
            </a>

            <div
                class="relative overflow-hidden bg-white border border-white/40 rounded-[2.5rem] p-8 md:p-10 shadow-2xl group transition-all duration-500 hover:shadow-primary-500/10">
                <!-- Aurora Background -->
                <div class="absolute inset-0 bg-gradient-to-br from-white via-primary-50/30 to-indigo-50/20 opacity-80">
                </div>
                <div
                    class="absolute top-[-30%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-br from-primary-300/10 via-indigo-300/10 to-purple-200/10 rounded-full blur-[80px] animate-pulse-slow pointer-events-none mix-blend-multiply">
                </div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                    <div class="flex items-center gap-6">
                        <div
                            class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-primary-500 to-indigo-600 text-white flex items-center justify-center shadow-2xl transform group-hover:rotate-6 transition-all duration-500">
                            <i class="fas fa-box-open text-4xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-primary-500 uppercase tracking-[0.3em] mb-1">INVENTORY
                            </p>
                            <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight leading-tight">
                                รางวัลของฉัน</h1>
                            <p class="text-gray-500 font-medium text-lg mt-1">
                                คลังไอเทมและอุปกรณ์ตกแต่งโปรไฟล์ทั้งหมดของคุณ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Configuration (Bento Style) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Profile Preview Card -->
            <div
                class="lg:col-span-5 bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50/30 to-transparent opacity-50"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-full flex justify-between items-center mb-10">
                        <span
                            class="px-4 py-1.5 rounded-xl bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest border border-gray-100">
                            Equipped View
                        </span>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                            <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Active
                                Look</span>
                        </div>
                    </div>

                    @php
                        $frameItem = $user->equipped_frame_item;
                        $frameGradient = $frameItem && isset($frameItem->data['gradient'])
                            ? $frameItem->data['gradient']
                            : 'from-gray-200 to-gray-300';
                        $titleItem = $user->equipped_title_item;
                        $ncItem = $user->equipped_name_color_item;
                        $pbgItem = $user->equipped_profile_bg_item;
                    @endphp

                    <div class="relative mb-8">
                        <!-- Frame -->
                        <div
                            class="w-40 h-40 rounded-full bg-gradient-to-br {{ $frameGradient }} p-2 shadow-2xl relative z-10">
                            <div class="w-full h-full rounded-full bg-white p-1">
                                <img src="{{ $user->avatar_url }}" alt="Avatar"
                                    class="w-full h-full rounded-full object-cover shadow-inner">
                            </div>
                        </div>
                        @if($frameItem && isset($frameItem->data['icon']))
                            <div
                                class="absolute -bottom-2 -right-2 w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-xl border border-gray-100 z-20 text-2xl">
                                {{ $frameItem->data['icon'] }}
                            </div>
                        @endif
                        <!-- Aurora glow behind avatar -->
                        <div
                            class="absolute inset-0 bg-primary-500/20 blur-[60px] rounded-full scale-150 -z-10 group-hover:scale-[2] transition-transform duration-1000">
                        </div>
                    </div>

                    <div class="text-center space-y-4">
                        @if($titleItem)
                            <div
                                class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-gradient-to-r {{ $titleItem->rarity_color }} text-white font-black text-xs shadow-xl shadow-{{ explode('-', $titleItem->rarity_color)[1] ?? 'primary' }}-500/20">
                                <span>{{ $titleItem->data['emoji'] ?? '🏆' }}</span>
                                <span class="uppercase tracking-widest">{{ $titleItem->name }}</span>
                            </div>
                        @else
                            <div
                                class="px-6 py-2 rounded-full bg-gray-50 text-gray-300 font-bold text-[10px] uppercase tracking-widest border border-dashed border-gray-200">
                                No Title Equipped
                            </div>
                        @endif

                        <div>
                            <h3
                                class="text-3xl font-black {{ $ncItem->data['class'] ?? 'text-gray-800' }} tracking-tighter">
                                {{ $user->name }}</h3>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mt-1">
                                {{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Equipped Details Grid -->
            <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $equipped_list = [
                        ['label' => 'กรอบรูป', 'item' => $frameItem, 'icon' => 'fa-circle-user', 'color' => 'purple'],
                        ['label' => 'ธีมระบบ', 'item' => $user->equipped_theme_item, 'icon' => 'fa-palette', 'color' => 'pink'],
                        ['label' => 'ตำแหน่ง', 'item' => $titleItem, 'icon' => 'fa-crown', 'color' => 'amber'],
                        ['label' => 'สีชื่อ', 'item' => $ncItem, 'icon' => 'fa-signature', 'color' => 'indigo'],
                        ['label' => 'พื้นหลังการ์ด', 'item' => $pbgItem, 'icon' => 'fa-id-card', 'color' => 'cyan'],
                    ];
                @endphp

                @foreach($equipped_list as $eq)
                    <div
                        class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm flex items-center gap-6 group hover:shadow-xl transition-all">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-{{ $eq['color'] }}-500 to-{{ $eq['color'] }}-600 text-white flex items-center justify-center shadow-lg group-hover:rotate-6 transition-all">
                            <i class="fas {{ $eq['icon'] }} text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">
                                {{ $eq['label'] }}</p>
                            <p
                                class="text-sm font-black {{ $eq['item'] ? 'text-gray-800' : 'text-gray-300 italic font-medium' }} truncate">
                                {{ $eq['item']->name ?? 'ยังไม่ติดตั้ง' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if(session('success'))
            <div class="animate-in fade-in slide-in-from-top-4 duration-500">
                <div
                    class="bg-emerald-500 rounded-[2rem] p-6 text-white shadow-2xl shadow-emerald-500/20 flex items-center gap-6 relative overflow-hidden group">
                    <div
                        class="absolute inset-0 bg-white/10 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000">
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest opacity-80 mb-0.5">Notification Success
                        </p>
                        <p class="font-black text-lg leading-tight">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Inventory Sections -->
        @php
            $types = [
                'avatar_frame' => ['name' => 'กรอบรูปอวาตาร์', 'icon' => 'fa-circle-user', 'color' => 'purple', 'desc' => 'กรอบรูปสวยๆ สำหรับแสดงผลในโปรไฟล์'],
                'theme' => ['name' => 'ธีมระบบส่วนตัว', 'icon' => 'fa-palette', 'color' => 'pink', 'desc' => 'เปลี่ยนบรรยากาศการใช้งานด้วยสีที่คุณชอบ'],
                'title' => ['name' => 'ตำแหน่งพิเศษ', 'icon' => 'fa-crown', 'color' => 'amber', 'desc' => 'ตำแหน่งสุดเท่ที่จะปรากฏข้างชื่อของคุณ'],
                'name_color' => ['name' => 'สีชื่อพิเศษ', 'icon' => 'fa-signature', 'color' => 'indigo', 'desc' => 'สร้างอัตลักษณ์ที่โดดเด่นใน Leaderboard'],
                'profile_bg' => ['name' => 'พื้นหลังการ์ดโปรไฟล์', 'icon' => 'fa-id-card', 'color' => 'cyan', 'desc' => 'พื้นหลังสุดพรีเมียมสำหรับการ์ดข้อมูล'],
            ];
        @endphp

        @foreach($types as $typeKey => $typeInfo)
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-{{ $typeInfo['color'] }}-50 text-{{ $typeInfo['color'] }}-500 flex items-center justify-center border border-{{ $typeInfo['color'] }}-100 shadow-sm">
                            <i class="fas {{ $typeInfo['icon'] }} text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-gray-800 tracking-tight">{{ $typeInfo['name'] }}</h2>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">
                                {{ $grouped[$typeKey]->count() }} ITEMS OWNED</p>
                        </div>
                    </div>
                </div>

                @if($grouped[$typeKey]->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($grouped[$typeKey] as $userReward)
                            @php
                                $item = $userReward->rewardItem;
                                $isEquipped = $userReward->is_equipped;
                                $rarityParts = explode('-', $item->rarity_color);
                                $rarityColor = $rarityParts[1] ?? 'primary';
                            @endphp

                            <div
                                class="group relative bg-white rounded-[2.5rem] border {{ $isEquipped ? 'border-' . $rarityColor . '-500 ring-4 ring-' . $rarityColor . '-500/10' : 'border-gray-100' }} shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col">
                                <!-- Status Badge -->
                                @if($isEquipped)
                                    <div class="absolute top-4 right-4 z-10">
                                        <span
                                            class="px-4 py-1.5 rounded-full bg-{{ $rarityColor }}-500 text-white text-[9px] font-black uppercase tracking-[0.2em] shadow-lg animate-pulse">
                                            EQUIPPED
                                        </span>
                                    </div>
                                @endif

                                <!-- Preview Section -->
                                <div
                                    class="relative p-8 flex items-center justify-center bg-gray-50/50 min-h-[160px] group-hover:bg-white transition-colors">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br {{ $item->rarity_color }} opacity-[0.03] group-hover:opacity-[0.06] transition-opacity">
                                    </div>

                                    <div class="relative z-10 w-full flex flex-col items-center">
                                        @if($item->type === 'avatar_frame')
                                            <div
                                                class="w-24 h-24 rounded-full bg-gradient-to-br {{ $item->rarity_color }} p-1 my-2 shadow-2xl transform group-hover:scale-110 transition-transform">
                                                <div
                                                    class="w-full h-full rounded-full bg-white flex items-center justify-center text-gray-200">
                                                    <i class="fas fa-user text-4xl"></i>
                                                </div>
                                            </div>
                                        @elseif($item->type === 'theme')
                                            <div
                                                class="w-full h-20 rounded-2xl bg-gradient-to-br {{ $item->data['gradient'] ?? 'from-gray-100 to-gray-200' }} shadow-inner flex items-center justify-center border border-white/50">
                                                <i
                                                    class="fas fa-palette text-3xl text-white/40 group-hover:text-white/70 transition-colors"></i>
                                            </div>
                                        @elseif($item->type === 'title')
                                            <div class="text-center group-hover:scale-110 transition-transform">
                                                <div class="text-4xl mb-4 transform group-hover:rotate-12 transition-transform">
                                                    {{ $item->data['emoji'] ?? '🏆' }}</div>
                                                <div
                                                    class="px-4 py-2 rounded-xl bg-gradient-to-r {{ $item->rarity_color }} text-white font-black text-[10px] uppercase tracking-[0.2em] shadow-lg">
                                                    {{ $item->name }}
                                                </div>
                                            </div>
                                        @elseif($item->type === 'name_color')
                                            <div class="text-center py-4">
                                                <p
                                                    class="text-xl font-black {{ $item->data['class'] ?? 'text-gray-800' }} tracking-tighter group-hover:scale-110 transition-transform">
                                                    Sample User</p>
                                                <div
                                                    class="mt-2 h-1 w-12 mx-auto bg-gradient-to-r {{ $item->rarity_color }} rounded-full opacity-50 group-hover:w-20 transition-all">
                                                </div>
                                            </div>
                                        @elseif($item->type === 'profile_bg')
                                            <div
                                                class="w-full h-24 rounded-2xl {{ $item->data['class'] ?? 'bg-white' }} shadow-inner border border-white/40 flex items-center justify-center relative overflow-hidden">
                                                <div
                                                    class="absolute inset-0 bg-white/10 skew-x-12 transform group-hover:translate-x-full transition-transform duration-1000">
                                                </div>
                                                <div class="bg-white/30 backdrop-blur-md p-3 rounded-xl border border-white/30">
                                                    <i class="fas fa-user-circle text-2xl text-gray-800/20"></i>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Info Section -->
                                <div class="p-6 pt-8 bg-white flex-1 flex flex-col">
                                    <div class="mb-6">
                                        <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest mb-1">
                                            {{ $item->rarity_name }} ITEM</p>
                                        <h3 class="font-black text-gray-800 text-lg leading-tight">{{ $item->name }}</h3>
                                        <p class="text-[10px] font-bold text-gray-400 mt-2 flex items-center gap-1.5 uppercase">
                                            <i class="far fa-calendar-check text-{{ $rarityColor }}-500"></i>
                                            Owned since {{ $userReward->purchased_at->format('M Y') }}
                                        </p>
                                    </div>

                                    <div class="mt-auto pt-4">
                                        @if($isEquipped)
                                            <form action="{{ route('typing.shop.unequip', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full py-4 bg-gray-50 text-gray-400 font-black text-xs uppercase tracking-widest rounded-2xl border border-gray-100 hover:bg-red-50 hover:text-red-500 hover:border-red-100 transition-all flex items-center justify-center gap-2 group-btn">
                                                    <i class="fas fa-power-off transition-transform group-btn:rotate-12"></i>
                                                    UNEQUIP
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('typing.shop.equip', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full py-4 bg-gray-900 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-{{ $rarityColor }}-500 hover:shadow-2xl hover:shadow-{{ $rarityColor }}-500/30 hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                                                    <i class="fas fa-hand-sparkles"></i>
                                                    EQUIP ITEM
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        class="bg-white/30 border-2 border-dashed border-gray-100 rounded-[2.5rem] p-12 text-center group hover:border-{{ $typeInfo['color'] }}-100 transition-all">
                        <div
                            class="w-16 h-16 mx-auto rounded-3xl bg-gray-50 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all">
                            <i class="fas {{ $typeInfo['icon'] }} text-2xl text-gray-200"></i>
                        </div>
                        <p class="text-sm font-black text-gray-400 uppercase tracking-widest mb-6">คุณยังไม่มีไอเทมหมวดนี้</p>
                        <a href="{{ route('typing.shop.index', ['type' => $typeKey]) }}"
                            class="inline-flex items-center gap-2 px-8 py-3 bg-white border border-gray-100 rounded-2xl text-xs font-black text-gray-800 hover:text-{{ $typeInfo['color'] }}-500 hover:shadow-xl transition-all">
                            <i class="fas fa-shopping-cart"></i>
                            ไปที่หน้าซื้อของ
                        </a>
                    </div>
                @endif
            </div>
        @endforeach

        @if($rewards->count() === 0)
            <div class="relative overflow-hidden bg-white border border-gray-100 rounded-[3rem] p-16 text-center shadow-xl">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50/20 to-transparent"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-32 h-32 rounded-[2.5rem] bg-gray-50 flex items-center justify-center mb-8 shadow-inner">
                        <i class="fas fa-gift text-5xl text-gray-200"></i>
                    </div>
                    <h3 class="text-3xl font-black text-gray-800 tracking-tight mb-4">คลังรางวัลของคุณยังว่างเปล่า</h3>
                    <p class="text-gray-500 font-medium text-lg max-w-md mx-auto mb-10 leading-relaxed">
                        เริ่มสะสมคะแนนจากการฝึกพิมพ์บทเรียน แล้วนำมาแลกไอเทมตกแต่งโปรไฟล์สุดหรูให้เพื่อนๆ ได้ว้าวกัน!
                    </p>
                    <a href="{{ route('typing.shop.index') }}"
                        class="group relative px-12 py-5 bg-gray-900 text-white font-black rounded-3xl hover:bg-primary-600 hover:shadow-2xl hover:shadow-primary-500/20 hover:-translate-y-1 transition-all overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000">
                        </div>
                        <span class="relative z-10 flex items-center gap-3">
                            <i class="fas fa-store"></i>
                            เข้าร่วมการช้อปปิ้งรางวัล
                        </span>
                    </a>
                </div>
            </div>
        @endif
    </div>

    <style>
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.8;
            }

            50% {
                opacity: 0.4;
            }
        }
    </style>
</x-typing-app>