<x-typing-app :role="'student'" :title="'คลังเอกสารตัวอย่าง - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    
    <!-- Hero Section -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-700 shadow-xl mb-10 text-white">
        <div class="absolute -top-24 -right-24 w-64 h-64 rounded-full bg-white opacity-10 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/4 w-48 h-48 rounded-full bg-pink-400 opacity-20 blur-2xl"></div>
        <div class="absolute top-1/3 right-1/3 w-32 h-32 rounded-full bg-cyan-400 opacity-15 blur-xl"></div>
        
        <div class="relative z-10 px-8 py-12 md:py-16">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-4 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-sm font-medium border border-white/10 flex items-center gap-2">
                        <i class="fas fa-book-open"></i> Template Library
                    </span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">คลังเอกสารตัวอย่าง</h1>
                <p class="text-violet-100 text-lg md:text-xl max-w-2xl">
                    ศึกษารูปแบบการพิมพ์หนังสือราชการที่ถูกต้องจากเอกสารตัวอย่างคุณภาพ เพื่อพัฒนาทักษะการพิมพ์ของคุณ
                </p>
            </div>
        </div>
    </div>

    @if($featuredTemplates->count() > 0)
        <!-- Featured Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white shadow-lg">
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">เอกสารแนะนำ</h2>
                        <p class="text-sm text-gray-500">เอกสารตัวอย่างที่ผู้สอนแนะนำให้ศึกษา</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($featuredTemplates as $template)
                    <a href="{{ route('typing.student.templates.show', $template) }}" 
                       class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-violet-200 hover:-translate-y-1 transition-all duration-300">
                        <!-- Featured Badge -->
                        <div class="absolute top-4 left-4 z-10">
                            <span class="px-3 py-1.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-xs font-bold rounded-full shadow-lg flex items-center gap-1">
                                <i class="fas fa-star"></i> แนะนำ
                            </span>
                        </div>

                        <!-- Thumbnail -->
                        <div class="relative h-44 bg-gradient-to-br from-violet-100 to-purple-50 flex items-center justify-center overflow-hidden">
                            @if($template->thumbnail)
                                <img src="{{ Storage::url($template->thumbnail) }}" alt="{{ $template->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="text-center">
                                    @php
                                        $iconClass = match(strtolower($template->file_type)) {
                                            'pdf' => 'fa-file-pdf text-red-400',
                                            'doc', 'docx' => 'fa-file-word text-blue-400',
                                            default => 'fa-file text-gray-400'
                                        };
                                    @endphp
                                    <i class="fas {{ $iconClass }} text-6xl mb-2 group-hover:scale-110 transition-transform duration-300"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-5">
                            <span class="inline-block px-2.5 py-1 bg-violet-100 text-violet-700 text-xs font-semibold rounded-lg mb-3">
                                {{ $template->category }}
                            </span>
                            <h3 class="font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-violet-600 transition-colors">{{ $template->title }}</h3>
                            
                            <div class="flex items-center justify-between text-xs text-gray-400 mt-3 pt-3 border-t border-gray-100">
                                <span class="flex items-center gap-1">
                                    <i class="fas fa-download"></i> {{ number_format($template->download_count) }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <i class="fas fa-hdd"></i> {{ $template->formatted_file_size }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Filter & Search -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="ค้นหาเอกสารตัวอย่าง..." 
                           class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-violet-500 focus:ring-2 focus:ring-violet-200 transition-all">
                </div>
            </div>
            <div class="w-full md:w-64">
                <select name="category" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-violet-500 focus:ring-2 focus:ring-violet-200 transition-all">
                    <option value="">-- ทุกหมวดหมู่ --</option>
                    @foreach($categories as $key => $value)
                        <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white font-semibold rounded-xl transition-colors flex items-center justify-center gap-2">
                <i class="fas fa-search"></i>
                <span>ค้นหา</span>
            </button>
            @if(request('search') || request('category'))
                <a href="{{ route('typing.student.templates.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-times"></i>
                    <span>ล้าง</span>
                </a>
            @endif
        </form>
    </div>

    <!-- All Templates -->
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-1 flex items-center gap-2">
            <span class="w-1.5 h-6 bg-gradient-to-b from-violet-500 to-purple-600 rounded-full"></span>
            เอกสารตัวอย่างทั้งหมด
        </h2>
        <p class="text-sm text-gray-500 ml-4">รวมเอกสารตัวอย่าง {{ $templates->total() }} รายการ</p>
    </div>

    <!-- Templates Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
        @forelse($templates as $template)
            <a href="{{ route('typing.student.templates.show', $template) }}" 
               class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:border-violet-200 hover:-translate-y-1 transition-all duration-300">
                <!-- Thumbnail -->
                <div class="relative h-40 bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center overflow-hidden">
                    @if($template->thumbnail)
                        <img src="{{ Storage::url($template->thumbnail) }}" alt="{{ $template->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="text-center">
                            @php
                                $iconClass = match(strtolower($template->file_type)) {
                                    'pdf' => 'fa-file-pdf text-red-400',
                                    'doc', 'docx' => 'fa-file-word text-blue-400',
                                    default => 'fa-file text-gray-400'
                                };
                            @endphp
                            <i class="fas {{ $iconClass }} text-5xl mb-2 group-hover:scale-110 transition-transform duration-300"></i>
                            <p class="text-xs text-gray-400 uppercase font-semibold">{{ $template->file_type }}</p>
                        </div>
                    @endif

                    <!-- Featured Badge -->
                    @if($template->is_featured)
                        <div class="absolute top-3 left-3">
                            <span class="px-2 py-1 bg-amber-500 text-white text-xs font-bold rounded-lg shadow-sm flex items-center gap-1">
                                <i class="fas fa-star text-[10px]"></i> แนะนำ
                            </span>
                        </div>
                    @endif

                    <!-- Category Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="px-2 py-1 bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-medium rounded-lg shadow-sm">
                            {{ $template->category }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5">
                    <h3 class="font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-violet-600 transition-colors min-h-[48px]">
                        {{ $template->title }}
                    </h3>
                    
                    @if($template->description)
                        <p class="text-sm text-gray-500 mb-3 line-clamp-2">{{ $template->description }}</p>
                    @endif

                    <!-- Stats -->
                    <div class="flex items-center justify-between text-xs text-gray-400 pt-3 border-t border-gray-100">
                        <span class="flex items-center gap-1">
                            <i class="fas fa-download"></i> {{ number_format($template->download_count) }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="fas fa-eye"></i> {{ number_format($template->view_count) }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="fas fa-hdd"></i> {{ $template->formatted_file_size }}
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full">
                <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                        <i class="fas fa-folder-open text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-600 mb-2">ไม่พบเอกสารตัวอย่าง</h3>
                    <p class="text-gray-400">{{ request('search') || request('category') ? 'ลองเปลี่ยนเงื่อนไขการค้นหา' : 'ยังไม่มีเอกสารตัวอย่างในระบบ' }}</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($templates->hasPages())
        <div class="flex justify-center">
            {{ $templates->links() }}
        </div>
    @endif

    <!-- Tips Section -->
    <div class="mt-12 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl shadow-lg p-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-48 h-48 bg-violet-500 opacity-10 rounded-full -mr-20 -mt-20 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-cyan-500 opacity-10 rounded-full -ml-10 -mb-10 blur-xl"></div>
        
        <div class="relative z-10">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-violet-500/20 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-lightbulb text-amber-400 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-2">เคล็ดลับการศึกษาเอกสารตัวอย่าง</h3>
                    <ul class="text-slate-300 space-y-2 text-sm">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-400 mt-0.5"></i>
                            สังเกตรูปแบบการจัดหน้า ระยะขอบ และการจัดวางองค์ประกอบต่างๆ
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-400 mt-0.5"></i>
                            ศึกษาการใช้ภาษา รูปแบบการเขียนที่เป็นทางการ
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-green-400 mt-0.5"></i>
                            สังเกตลำดับขั้นตอนและโครงสร้างของเอกสารแต่ละประเภท
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-typing-app>
