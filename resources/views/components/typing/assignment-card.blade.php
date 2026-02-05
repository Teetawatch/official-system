@props(['assignment'])

@php
    $submission = $assignment->submissions->first();
    $status = 'pending';
    if ($submission) {
        $status = $submission->score !== null ? 'graded' : 'submitted';
    }

    // Determine styling based on status and urgency
    $isExpired = $status == 'pending' && $assignment->due_date && now()->greaterThan($assignment->due_date);
    $isUrgent = !$isExpired && $status == 'pending' && $assignment->due_date && $assignment->due_date->isFuture() && $assignment->due_date->diffInDays(now()) <= 2;

    if ($status == 'graded') {
        $borderColor = 'border-secondary-500';
        $iconBg = 'bg-gradient-to-br from-secondary-500 to-secondary-600';
        $icon = 'fa-check-circle';
        // HTML Badge
        $statusBadge = '<span class="px-2 py-1 rounded text-xs font-semibold bg-secondary-100 text-secondary-600 border border-secondary-200">ให้คะแนนแล้ว</span>';
    } elseif ($status == 'submitted') {
        $borderColor = 'border-blue-500';
        $iconBg = 'bg-gradient-to-br from-blue-500 to-blue-600';
        $icon = 'fa-hourglass-half';
        $statusBadge = '<span class="px-2 py-1 rounded text-xs font-semibold bg-blue-100 text-blue-600 border border-blue-200">รอตรวจ</span>';
    } elseif ($isExpired) {
        $borderColor = 'border-gray-400';
        $iconBg = 'bg-gradient-to-br from-gray-400 to-gray-500';
        $icon = 'fa-lock';
        $statusBadge = '<span class="px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">หมดเวลาส่ง</span>';
    } elseif ($isUrgent) {
        $borderColor = 'border-red-500';
        $iconBg = 'bg-gradient-to-br from-red-500 to-red-600';
        $icon = 'fa-fire';
        $statusBadge = '<span class="px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-600 border border-red-200"><i class="fas fa-exclamation-triangle mr-1"></i>ด่วน!</span>';
    } else {
        $borderColor = 'border-amber-500';
        $iconBg = 'bg-gradient-to-br from-amber-500 to-orange-500';
        $icon = 'fa-file-alt';
        $statusBadge = '<span class="px-2 py-1 rounded text-xs font-semibold bg-amber-100 text-amber-600 border border-amber-200">เปิดรับงาน</span>';
    }
@endphp

<div class="card p-0 overflow-hidden border-l-4 {{ $borderColor }} {{ $isExpired ? 'opacity-75 grayscale-[0.5]' : '' }}">
    <div class="p-5">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-start gap-4">
                <div class="w-14 h-14 rounded-xl {{ $iconBg }} flex items-center justify-center flex-shrink-0 shadow-lg">
                    <i class="fas {{ $icon }} text-white text-xl"></i>
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $assignment->title }}</h3>
                        {!! $statusBadge !!}
                    </div>
                    <p class="text-sm text-gray-500 mb-2 truncate max-w-md">
                        {{ Str::limit($assignment->content, 80) }}
                    </p>
                    <div class="flex flex-wrap items-center gap-4 text-sm">
                        <span class="text-gray-500">
                            <i class="fas fa-star mr-1"></i>
                            คะแนนเต็ม: {{ $assignment->max_score }}
                        </span>

                        @if($assignment->time_limit)
                            <span class="text-gray-500">
                                <i class="fas fa-clock mr-1"></i>
                                จำกัดเวลา: {{ $assignment->time_limit }} นาที
                            </span>
                        @endif

                        @if($status == 'graded')
                            <span class="text-secondary-600 font-semibold">
                                <i class="fas fa-check mr-1"></i>
                                คะแนนที่ได้: {{ $submission->score }}
                            </span>
                        @elseif($status == 'submitted')
                            <span class="text-blue-600">
                                <i class="fas fa-clock mr-1"></i>
                                ส่งเมื่อ: {{ $submission->created_at->format('d/m/Y') }}
                            </span>
                        @elseif($assignment->due_date)
                            <span class="{{ $isUrgent ? 'text-red-600 font-medium' : ($isExpired ? 'text-red-500 font-medium' : 'text-gray-500') }}">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $isExpired ? 'หมดเขตเมื่อ:' : 'ครบกำหนด:' }}
                                {{ $assignment->due_date->format('d/m/Y H:i') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 md:flex-shrink-0">
                {{-- Actions --}}
                @if($status == 'pending')
                    <a href="#" class="btn-outline py-2 {{ $isExpired ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                        <i class="fas fa-eye mr-1"></i>
                        รายละเอียด
                    </a>
                    @if($isExpired)
                        <button disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed font-medium text-sm flex items-center">
                            <i class="fas fa-lock mr-2"></i>
                            ปิดรับแล้ว
                        </button>
                    @elseif($assignment->submission_type === 'file')
                        <a href="{{ route('typing.student.upload', $assignment->id) }}" class="btn-primary py-2">
                            <i class="fas fa-file-upload mr-1"></i>
                            อัปโหลดไฟล์
                        </a>
                    @else
                        <a href="{{ route('typing.student.practice', $assignment->id) }}" class="btn-primary py-2">
                            <i class="fas fa-keyboard mr-1"></i>
                            เริ่มพิมพ์
                        </a>
                    @endif
                @else
                    <a href="{{ route('typing.student.submissions.show', $submission->id) }}" class="btn-ghost py-2">
                        <i class="fas fa-eye mr-1"></i>
                        ดูผลงาน
                    </a>
                    @if($status == 'graded')
                        <a href="#" class="btn-outline py-2">
                            <i class="fas fa-comment mr-1"></i>
                            Feedback
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
