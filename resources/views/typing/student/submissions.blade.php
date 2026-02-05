<x-typing-app :role="'student'" :title="'งานที่ส่งแล้ว - ระบบวิชาพิมพ์หนังสือราชการ 1'">
    <div class="space-y-10 pb-12">

        <!-- Aurora & Glass Header -->
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
                        class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-indigo-500 to-primary-600 text-white flex items-center justify-center shadow-2xl transform group-hover:rotate-6 transition-all duration-500">
                        <i class="fas fa-paper-plane text-4xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-gray-800 tracking-tight mb-2">งานที่ส่งแล้ว</h1>
                        <p class="text-gray-500 font-medium text-lg flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                            ประวัติการส่งงานและการวัดผลทั้งหมดของคุณ
                        </p>
                    </div>
                </div>

                <div
                    class="flex items-center gap-4 bg-white/50 backdrop-blur-md p-2 rounded-2xl border border-white/50">
                    <div class="px-4 py-2">
                        <p
                            class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1 text-center">
                            FILTER STATUS</p>
                        <select class="bg-transparent border-none font-bold text-gray-800 focus:ring-0 cursor-pointer">
                            <option value="">ทุกสถานะ</option>
                            <option value="pending">รอตรวจ</option>
                            <option value="graded">ตรวจแล้ว</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Premium Table Section -->
        <div
            class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden transition-all duration-500 hover:shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                                Assignment</th>
                            <th class="px-6 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Date
                                Submitted</th>
                            <th class="px-6 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Typing
                                Performance</th>
                            <th class="px-6 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status
                            </th>
                            <th class="px-6 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Final
                                Score</th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-center">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($submissions as $submission)
                            <tr class="group hover:bg-primary-50/30 transition-all duration-300">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-50 to-blue-50 text-indigo-500 flex items-center justify-center border border-indigo-100 group-hover:scale-110 transition-transform">
                                            <i class="fas fa-file-alt text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="font-black text-gray-800 tracking-tight">
                                                {{ $submission->assignment->title }}</p>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Max
                                                Score: {{ $submission->assignment->max_score }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="space-y-0.5">
                                        <p class="text-sm font-black text-gray-700">
                                            {{ $submission->created_at->format('d M Y') }}</p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                            {{ $submission->created_at->format('H:i') }} น.</p>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-6">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Speed</span>
                                            <div class="flex items-baseline gap-1">
                                                <span
                                                    class="text-lg font-black text-primary-600">{{ $submission->wpm }}</span>
                                                <span class="text-[9px] font-bold text-gray-400 uppercase">WPM</span>
                                            </div>
                                        </div>
                                        <div class="w-px h-8 bg-gray-100"></div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Accuracy</span>
                                            <div class="flex items-baseline gap-1">
                                                <span
                                                    class="text-lg font-black text-emerald-500">{{ $submission->accuracy }}</span>
                                                <span class="text-[9px] font-bold text-gray-400 uppercase">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    @if($submission->score !== null)
                                        <span
                                            class="px-3 py-1.5 rounded-xl text-[10px] font-black bg-emerald-50 text-emerald-600 border border-emerald-100 uppercase tracking-widest">
                                            <i class="fas fa-check-circle mr-1"></i> ตรวจแล้ว
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1.5 rounded-xl text-[10px] font-black bg-amber-50 text-amber-600 border border-amber-100 uppercase tracking-widest animate-pulse">
                                            <i class="fas fa-hourglass-half mr-1"></i> รอตรวจ
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-6">
                                    @if($submission->score !== null)
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-2xl font-black text-gray-800">{{ $submission->score }}</span>
                                            <span class="text-xs font-bold text-gray-400 italic">/
                                                {{ $submission->assignment->max_score }}</span>
                                        </div>
                                    @else
                                        <span class="text-sm font-black text-gray-300 tracking-widest">PENDING</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <a href="{{ route('typing.student.submissions.show', $submission->id) }}"
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-white text-gray-400 border border-gray-100 hover:bg-primary-500 hover:text-white hover:border-primary-500 hover:shadow-lg hover:shadow-primary-500/20 transition-all">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-24 text-center">
                                    <div
                                        class="w-20 h-20 bg-gray-50 rounded-[2rem] flex items-center justify-center mx-auto mb-4 text-gray-200 border border-dashed border-gray-100">
                                        <i class="fas fa-history text-3xl"></i>
                                    </div>
                                    <h3 class="text-xl font-black text-gray-400 uppercase tracking-widest">
                                        ไม่พบประวัติการส่งงาน</h3>
                                    <p class="text-gray-500 mt-1">เริ่มฝึกฝนและส่งงานแรกของคุณได้ที่หน้ารายงาน</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination -->
            @if($submissions->hasPages())
                <div
                    class="px-8 py-6 bg-gray-50/50 border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Showing <span class="text-gray-800">{{ $submissions->firstItem() }}</span> to <span
                            class="text-gray-800">{{ $submissions->lastItem() }}</span> of <span
                            class="text-gray-800">{{ $submissions->total() }}</span> Results
                    </p>
                    <div class="premium-pagination">
                        {{ $submissions->links() }}
                    </div>
                </div>
            @endif
        </div>
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

        /* Custom Pagination Styling to match premium theme */
        .premium-pagination nav {
            display: flex;
            gap: 0.5rem;
        }

        .premium-pagination .relative.inline-flex {
            border-radius: 12px !important;
            border: 1px solid #f3f4f6 !important;
            font-weight: 800;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.3s;
        }

        .premium-pagination .bg-white {
            background: white !important;
        }

        .premium-pagination .text-gray-700:hover {
            background: #f9fafb !important;
            border-color: #e5e7eb !important;
            transform: translateY(-1px);
        }

        .premium-pagination span[aria-current="page"] .relative {
            background: #6366f1 !important;
            color: white !important;
            border-color: #6366f1 !important;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }
    </style>
</x-typing-app>