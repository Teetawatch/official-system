<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานคะแนน - ระบบวิชาพิมพ์หนังสือราชการ 1</title>
    <!-- Import FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Sarabun', 'TH Sarabun New', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            background: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #2563eb;
        }

        .header h1 {
            font-size: 24px;
            color: #2563eb;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .summary {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            flex: 1;
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        .summary-card .value {
            font-size: 28px;
            font-weight: bold;
            color: #2563eb;
        }

        .summary-card .label {
            font-size: 12px;
            color: #64748b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #e2e8f0;
            padding: 10px 8px;
            text-align: center;
        }

        th {
            background: #2563eb;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background: #f8fafc;
        }

        tr:hover {
            background: #e0f2fe;
        }

        .name-cell {
            text-align: left;
        }

        .score-high {
            color: #16a34a;
            font-weight: bold;
        }

        .score-low {
            color: #dc2626;
            font-weight: bold;
        }

        .grade-4 {
            color: #2563eb;
            font-weight: bold;
        }

        .grade-3-5 {
            color: #3b82f6;
            font-weight: bold;
        }

        .grade-3 {
            color: #eab308;
            font-weight: bold;
        }

        .grade-2-5 {
            color: #f59e0b;
            font-weight: bold;
        }

        .grade-2 {
            color: #f97316;
            font-weight: bold;
        }

        .grade-1-5 {
            color: #ef4444;
            font-weight: bold;
        }

        .grade-1 {
            color: #dc2626;
            font-weight: bold;
        }

        .grade-0 {
            color: #64748b;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 12px;
        }

        .print-btn {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
            /* Right align button */
        }

        .print-btn:hover {
            background: #1d4ed8;
        }

        @media print {
            .print-btn {
                display: none;
            }

            body {
                font-size: 10px;
                background: white;
                /* Ensure white background */
            }

            th,
            td {
                padding: 4px 2px;
                /* Reduce padding for print */
                font-size: 9pt;
            }

            .header h1 {
                font-size: 18pt;
            }

            .summary {
                margin-bottom: 15px;
            }

            /* Ensure colors print correctly */
            th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
    <script>
        // Auto print when loaded
        window.onload = function () {
            setTimeout(function () {
                window.print();
            }, 500); // Small delay to ensure styles align
        };
    </script>
</head>

<body>
    <div class="container">
        <button class="print-btn" onclick="window.print()">
            <i class="fas fa-print"></i> พิมพ์รายงาน / บันทึกเป็น PDF
        </button>

        <div class="header">
            <h1>รายงานคะแนนนักเรียน</h1>
            <p>ระบบวิชาพิมพ์หนังสือราชการ 1 | วันที่พิมพ์: {{ now()->format('d/m/Y H:i') }}</p>
        </div>

        <div class="summary">
            <div class="summary-card">
                <div class="value">{{ $totalStudents }}</div>
                <div class="label">จำนวนนักเรียน</div>
            </div>
            <div class="summary-card">
                <div class="value">{{ $assignments->count() }}</div>
                <div class="label">จำนวนบทเรียน</div>
            </div>
            <div class="summary-card">
                <div class="value">{{ number_format($averageScore, 1) }}</div>
                <div class="label">คะแนนเฉลี่ย</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 40px;">ลำดับ</th>
                    <th style="width: 80px;">รหัส</th>
                    <th class="name-cell">ชื่อ-นามสกุล</th>
                    <th style="width: 60px;">ห้อง</th>
                    @foreach($assignments as $assignment)
                        <th style="width: 70px;">{{ Str::limit($assignment->title, 10) }}</th>
                    @endforeach
                    <th style="width: 60px;">รวม</th>
                    <th style="width: 60px;">เฉลี่ย</th>
                    <th style="width: 60px;">เกรด</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $index => $student)
                    @php
                        $totalScore = 0;
                        $scoreCount = 0;
                        foreach ($assignments as $assignment) {
                            $submission = $student->typingSubmissions->firstWhere('assignment_id', $assignment->id);
                            if ($submission && $submission->score !== null) {
                                $totalScore += $submission->score;
                                $scoreCount++;
                            }
                        }
                        $avgScore = $scoreCount > 0 ? $totalScore / $scoreCount : 0;

                        // Calculate grade
                        $grade = '0';
                        $gradeClass = 'grade-0';
                        if ($totalScore >= 80) {
                            $grade = '4';
                            $gradeClass = 'grade-4';
                        } elseif ($totalScore >= 75) {
                            $grade = '3.5';
                            $gradeClass = 'grade-3-5';
                        } elseif ($totalScore >= 70) {
                            $grade = '3';
                            $gradeClass = 'grade-3';
                        } elseif ($totalScore >= 65) {
                            $grade = '2.5';
                            $gradeClass = 'grade-2-5';
                        } elseif ($totalScore >= 60) {
                            $grade = '2';
                            $gradeClass = 'grade-2';
                        } elseif ($totalScore >= 55) {
                            $grade = '1.5';
                            $gradeClass = 'grade-1-5';
                        } elseif ($totalScore >= 50) {
                            $grade = '1';
                            $gradeClass = 'grade-1';
                        }
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->student_id ?? '-' }}</td>
                        <td class="name-cell">{{ $student->name }}</td>
                        <td>{{ $student->class_name ?? '-' }}</td>
                        @foreach($assignments as $assignment)
                            @php
                                $submission = $student->typingSubmissions->firstWhere('assignment_id', $assignment->id);
                                $score = $submission ? $submission->score : null;
                            @endphp
                            <td
                                class="{{ $score !== null ? ($score >= 80 ? 'score-high' : ($score < 50 ? 'score-low' : '')) : '' }}">
                                {{ $score !== null ? $score : '-' }}
                            </td>
                        @endforeach
                        <td><strong>{{ $totalScore }}</strong></td>
                        <td
                            class="{{ $avgScore >= 80 ? 'score-high' : ($avgScore < 50 && $avgScore > 0 ? 'score-low' : '') }}">
                            {{ $scoreCount > 0 ? number_format($avgScore, 1) : '-' }}%
                        </td>
                        <td class="{{ $gradeClass }}">
                            {{ $grade }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>© {{ date('Y') }} ระบบวิชาพิมพ์หนังสือราชการ 1 | พิมพ์โดย: {{ auth()->user()->name }}</p>
        </div>
    </div>
</body>

</html>