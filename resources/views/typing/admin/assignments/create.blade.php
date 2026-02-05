<x-typing-app :role="'admin'" :title="'สร้างบทเรียนใหม่ - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    <div class="space-y-10 pb-12">

        <!-- Aurora & Glass Header -->
        <div
            class="relative overflow-hidden bg-white border border-white/40 rounded-[2.5rem] p-8 shadow-2xl group transition-all duration-500 hover:shadow-primary-500/10">
            <!-- Aurora Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-white via-blue-50/50 to-indigo-50/30 opacity-80"></div>
            <div
                class="absolute top-[-30%] right-[-10%] w-[600px] h-[600px] bg-gradient-to-br from-blue-300/10 via-primary-300/10 to-indigo-200/10 rounded-full blur-[80px] animate-pulse-slow pointer-events-none mix-blend-multiply">
            </div>
            <div
                class="absolute bottom-[-20%] left-[-10%] w-[500px] h-[500px] bg-gradient-to-tr from-indigo-200/10 via-blue-200/10 to-purple-200/10 rounded-full blur-[80px] animate-pulse-slow delay-1000 pointer-events-none mix-blend-multiply">
            </div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-indigo-600 text-white flex items-center justify-center shadow-lg shadow-primary-500/30 transform group-hover:rotate-6 transition-transform">
                        <i class="fas fa-plus text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight">สร้างบทเรียนใหม่</h1>
                        <p class="text-gray-500 mt-1 font-medium flex items-center gap-2 text-lg">
                            <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></span>
                            เพิ่มเนื้อหาการฝึกพิมพ์ใหม่เข้าสู่ระบบ
                        </p>
                    </div>
                </div>

                <a href="{{ route('typing.admin.assignments.index') }}"
                    class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-white/60 backdrop-blur-md border border-white text-gray-600 font-black hover:bg-gray-50 hover:shadow-xl hover:-translate-y-0.5 transition-all shadow-sm">
                    <i class="fas fa-arrow-left text-primary-500"></i>
                    ย้อนกลับ
                </a>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden relative">
            <div
                class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary-500 via-indigo-500 to-purple-600">
            </div>

            <form action="{{ route('typing.admin.assignments.store') }}" method="POST" enctype="multipart/form-data"
                class="p-8 md:p-12">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8 mb-12">
                    <!-- Chapter & Title -->
                    <div class="space-y-8">
                        <div>
                            <label for="chapter"
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">บทที่
                                (Chapter)</label>
                            <div class="relative group">
                                <input type="text" name="chapter" id="chapter"
                                    class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all font-bold text-gray-800"
                                    placeholder="เช่น บทที่ 1">
                                <div
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                    <i class="fas fa-bookmark text-lg"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="title"
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">หัวข้อบทเรียน
                                <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <input type="text" name="title" id="title" required
                                    class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all font-bold text-gray-800"
                                    placeholder="เช่น การพิมพ์สัมผัสเบื้องต้น">
                                <div
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                    <i class="fas fa-heading text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Type & Status -->
                    <div class="space-y-8">
                        <div>
                            <label for="type"
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">ประเภทเอกสาร</label>
                            <div class="relative group">
                                <select name="type" id="type"
                                    class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 transition-all appearance-none cursor-pointer font-bold text-gray-800">
                                    <option value="memo">บันทึกข้อความ</option>
                                    <option value="external">หนังสือภายนอก</option>
                                    <option value="command">คำสั่ง</option>
                                </select>
                                <div
                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                    <i class="fas fa-file-alt text-lg"></i>
                                </div>
                                <div
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 pointer-events-none">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between p-5 rounded-[2rem] bg-gray-50/50 border border-gray-100">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-emerald-500">
                                    <i class="fas fa-toggle-on text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-gray-800">เปิดใช้งานทันที</p>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                                        ให้นักเรียนเริ่มใช้งานได้ทันที</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                                <div
                                    class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary-500 shadow-inner">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submission Type Selection (Premium Gradient Cards) -->
                <div class="mb-12" x-data="{ submissionType: 'file' }">
                    <label
                        class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 px-2">รูปแบบการส่งงาน</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="group relative cursor-pointer">
                            <input type="radio" name="submission_type" value="file" x-model="submissionType"
                                class="sr-only">
                            <div class="relative overflow-hidden p-8 rounded-[2.5rem] border-2 transition-all duration-500 h-full flex flex-col items-center text-center gap-4"
                                :class="submissionType === 'file' ? 'border-primary-500 bg-primary-50/30' : 'border-gray-100 bg-white hover:border-gray-200'">
                                <div class="w-20 h-20 rounded-[2rem] flex items-center justify-center text-3xl transition-all duration-500"
                                    :class="submissionType === 'file' ? 'bg-primary-500 text-white shadow-xl shadow-primary-500/20' : 'bg-gray-50 text-gray-400 group-hover:bg-primary-50 group-hover:text-primary-500'">
                                    <i class="fas fa-file-upload"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-black text-gray-800 mb-1">แนบไฟล์ (.docx)</h3>
                                    <p class="text-sm font-medium text-gray-500">นักเรียนอัปโหลดไฟล์ Word
                                        ตรวจรูปแบบและเนื้อหาอัตโนมัติ</p>
                                </div>
                                <div x-show="submissionType === 'file'" class="absolute top-4 right-4 text-primary-500">
                                    <i class="fas fa-check-circle text-xl"></i>
                                </div>
                            </div>
                        </label>

                        <label class="group relative cursor-pointer">
                            <input type="radio" name="submission_type" value="typing" x-model="submissionType"
                                class="sr-only">
                            <div class="relative overflow-hidden p-8 rounded-[2.5rem] border-2 transition-all duration-500 h-full flex flex-col items-center text-center gap-4"
                                :class="submissionType === 'typing' ? 'border-indigo-500 bg-indigo-50/30' : 'border-gray-100 bg-white hover:border-gray-200'">
                                <div class="w-20 h-20 rounded-[2rem] flex items-center justify-center text-3xl transition-all duration-500"
                                    :class="submissionType === 'typing' ? 'bg-indigo-500 text-white shadow-xl shadow-indigo-500/20' : 'bg-gray-50 text-gray-400 group-hover:bg-indigo-50 group-hover:text-indigo-500'">
                                    <i class="fas fa-keyboard"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-black text-gray-800 mb-1">พิมพ์ในระบบ</h3>
                                    <p class="text-sm font-medium text-gray-500">
                                        นักเรียนพิมพ์ตามต้นฉบับที่กำหนดบนหน้าเว็บโดยตรง</p>
                                </div>
                                <div x-show="submissionType === 'typing'"
                                    class="absolute top-4 right-4 text-indigo-500">
                                    <i class="fas fa-check-circle text-xl"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Score, Difficulty & Date Settings -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div>
                        <label for="max_score"
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">คะแนนเต็ม</label>
                        <div class="relative group">
                            <input type="number" name="max_score" id="max_score" value="100"
                                class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all font-bold text-gray-800">
                            <div
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                <i class="fas fa-star text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="difficulty_level"
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">ระดับความยาก
                            (1-5)</label>
                        <div class="relative group">
                            <input type="number" name="difficulty_level" id="difficulty_level" min="1" max="5" value="1"
                                class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all font-bold text-gray-800">
                            <div
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                <i class="fas fa-bolt text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="due_date"
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">กำหนดส่ง
                            (Optional)</label>
                        <div class="relative group">
                            <input type="datetime-local" name="due_date" id="due_date"
                                class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all font-bold text-gray-800">
                            <div
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                <i class="fas fa-calendar-alt text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Content Sections based on submission_type -->
                <div x-data="{ submissionType: 'file' }"
                    x-init="submissionType = document.querySelector('input[name=submission_type]:checked')?.value || 'file'; 
                            document.querySelectorAll('input[name=submission_type]').forEach(el => el.addEventListener('change', () => submissionType = el.value))">

                    <!-- File Submission (Master File Upload) -->
                    <div x-show="submissionType === 'file'" x-cloak x-transition:enter="duration-500 ease-out"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="mb-12 p-8 rounded-[2.5rem] bg-indigo-50/50 border border-indigo-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-100/50 rounded-bl-full -mr-12 -mt-12">
                        </div>

                        <div class="relative z-10 space-y-8">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-indigo-500 text-xl font-black">
                                    <i class="fas fa-file-word"></i>
                                </div>
                                <h3 class="text-xl font-black text-gray-800">ตั้งค่าการตรวจไฟล์อัตโนมัติ</h3>
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">ไฟล์ต้นฉบับสำหรับระบบตรวจ
                                    (.docx)</label>
                                <label class="group relative block">
                                    <input type="file" name="master_file" accept=".docx" class="sr-only"
                                        id="master-file">
                                    <div @click="document.getElementById('master-file').click()"
                                        class="w-full p-8 py-10 rounded-[2rem] bg-white border-2 border-dashed border-indigo-200 hover:border-indigo-400 hover:bg-white/80 transition-all cursor-pointer text-center">
                                        <i
                                            class="fas fa-cloud-upload-alt text-4xl text-indigo-300 mb-4 group-hover:scale-110 transition-transform"></i>
                                        <p class="text-gray-400 font-bold">เลือกไฟล์ Word ที่ต้องการใช้เป็นต้นฉบับ</p>
                                        <p class="text-[10px] text-gray-300 uppercase tracking-widest mt-1">.DOCX ONLY •
                                            MAX 10MB</p>
                                    </div>
                                </label>
                            </div>

                            <div class="p-6 rounded-3xl bg-white/50 border border-indigo-100">
                                <label class="flex items-center justify-between cursor-pointer">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-indigo-500 text-white flex items-center justify-center shadow-lg shadow-indigo-500/20">
                                            <i class="fas fa-spell-check text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-black text-gray-800">เปิดโหมดตรวจรูปแบบเอกสาร</p>
                                            <p class="text-xs text-gray-400 font-medium">ตรวจฟอนต์ (Sarabun 16pt),
                                                ระยะขอบ, ขนาดกระดาษ และหัวเรื่อง</p>
                                        </div>
                                    </div>
                                    <input type="checkbox" name="check_formatting" value="1"
                                        class="w-6 h-6 rounded-lg border-2 border-indigo-200 text-indigo-500 focus:ring-indigo-500/20 transition-all cursor-pointer">
                                </label>
                            </div>

                            <div
                                class="flex items-center gap-2 text-xs font-bold text-indigo-400 px-2 uppercase tracking-widest">
                                <i class="fas fa-info-circle"></i>
                                สูตรคำนวณ: ตัวอักษร 70% + รูปแบบ 30%
                            </div>
                        </div>
                    </div>

                    <!-- Typing Submission (Content Textarea) -->
                    <div x-show="submissionType === 'typing'" x-cloak x-transition:enter="duration-500 ease-out"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="mb-12 space-y-8">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="md:col-span-2">
                                <label for="content"
                                    class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">เนื้อหาที่ต้องพิมพ์</label>
                                <div class="relative group">
                                    <textarea name="content" id="content" rows="12"
                                        class="w-full p-6 rounded-[2.5rem] bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-mono text-gray-800 leading-relaxed"
                                        placeholder="วางหรือพิมพ์เนื้อหาที่ต้องการให้นักเรียนพิมพ์ฝึกที่นี่..."></textarea>
                                    <div
                                        class="absolute bottom-6 right-8 text-[10px] font-black text-gray-300 uppercase tracking-tighter shimmer-text">
                                        โหมดตรวจอักขระเรียลไทม์
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-8">
                                <div>
                                    <label for="time_limit"
                                        class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-2">เวลาในการพิมพ์
                                        (นาที)</label>
                                    <div class="relative group">
                                        <input type="number" name="time_limit" id="time_limit" min="1" max="60"
                                            value="5"
                                            class="w-full pl-12 pr-4 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-gray-800">
                                        <div
                                            class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                            <i class="fas fa-clock text-lg"></i>
                                        </div>
                                    </div>
                                    <p class="text-[10px] font-medium text-gray-400 mt-2 px-2">
                                        นักเรียนจะมีเวลาเท่านี้เมื่อเริ่มกดปุ่มฝึกพิมพ์</p>
                                </div>

                                <div class="p-6 rounded-[2rem] bg-indigo-50/50 border border-indigo-100">
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-lightbulb text-indigo-400 mt-1"></i>
                                        <p class="text-xs font-black text-indigo-600/80 leading-relaxed uppercase">
                                            แนะนำ: ใช้เอกสารที่เนื้อหาตรงตามระเบียบงานสารบรรณเพื่อความสมจริง</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-between pt-8 border-t border-gray-50">
                    <button type="reset"
                        class="px-8 py-4 text-sm font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                        ล้างข้อมูล
                    </button>
                    <button type="submit"
                        class="group relative flex items-center gap-3 px-12 py-5 bg-primary-500 text-white font-black rounded-2xl hover:bg-primary-600 hover:shadow-2xl hover:-translate-y-1 transition-all shadow-xl shadow-primary-500/20 overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000">
                        </div>
                        <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                        บันทึกบทเรียนใหม่
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .animate-pulse-slow {
            animation: pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.2;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(1.1);
            }
        }

        [x-cloak] {
            display: none !important;
        }

        .shimmer-text {
            background: linear-gradient(90deg, #d1d5db 0%, #9ca3af 50%, #d1d5db 100%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
</x-typing-app>