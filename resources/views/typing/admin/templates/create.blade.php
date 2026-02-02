<x-typing-app :role="'admin'" :title="'อัปโหลดเอกสารตัวอย่าง - ระบบวิชาพิมพ์หนังสือราชการ 1'">

    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('typing.admin.templates.index') }}"
            class="inline-flex items-center gap-2 text-gray-500 hover:text-violet-600 transition-colors mb-4">
            <i class="fas fa-arrow-left"></i>
            <span>กลับไปคลังเอกสาร</span>
        </a>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">อัปโหลดเอกสารตัวอย่าง</h1>
        <p class="text-gray-500">เพิ่มเอกสารราชการตัวอย่างสำหรับให้นักเรียนศึกษา</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('typing.admin.templates.store') }}" method="POST" enctype="multipart/form-data"
            class="p-8">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            ชื่อเอกสาร <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-violet-500 focus:ring-2 focus:ring-violet-200 transition-all @error('title') border-red-500 @enderror"
                            placeholder="เช่น ตัวอย่างบันทึกข้อความขออนุมัติ">
                        @error('title')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                            หมวดหมู่ <span class="text-red-500">*</span>
                        </label>
                        <select id="category" name="category" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-violet-500 focus:ring-2 focus:ring-violet-200 transition-all @error('category') border-red-500 @enderror">
                            <option value="">-- เลือกหมวดหมู่ --</option>
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            คำอธิบาย
                        </label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-violet-500 focus:ring-2 focus:ring-violet-200 transition-all resize-none @error('description') border-red-500 @enderror"
                            placeholder="อธิบายรายละเอียดเกี่ยวกับเอกสารนี้...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Toggle -->
                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                class="w-5 h-5 rounded border-gray-300 text-violet-600 focus:ring-violet-500 transition-colors">
                            <div>
                                <span class="font-semibold text-gray-700">แนะนำเอกสารนี้</span>
                                <p class="text-sm text-gray-500">เอกสารจะแสดงในส่วนแนะนำสำหรับนักเรียน</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- File Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            ไฟล์เอกสาร <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="file" id="file" name="file" required accept=".doc,.docx,.pdf,.odt"
                                class="hidden" onchange="updateFileName(this, 'file-name')">
                            <label for="file"
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-violet-400 transition-all @error('file') border-red-500 @enderror">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-violet-400 mb-3"></i>
                                    <p class="mb-2 text-sm text-gray-600">
                                        <span class="font-semibold text-violet-600">คลิกเพื่อเลือกไฟล์</span>
                                    </p>
                                    <p class="text-xs text-gray-500">DOC, DOCX, PDF, ODT (สูงสุด 10MB)</p>
                                    <p id="file-name" class="mt-2 text-sm font-medium text-violet-600 hidden"></p>
                                </div>
                            </label>
                        </div>
                        @error('file')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Thumbnail Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            รูปปก (ตัวอย่าง)
                        </label>
                        <div class="relative">
                            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="hidden"
                                onchange="previewThumbnail(this)">
                            <label for="thumbnail"
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-violet-400 transition-all overflow-hidden @error('thumbnail') border-red-500 @enderror">
                                <div id="thumbnail-preview-container" class="hidden w-full h-full">
                                    <img id="thumbnail-preview" src="" alt="" class="w-full h-full object-cover">
                                </div>
                                <div id="thumbnail-placeholder"
                                    class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                    <i class="fas fa-image text-4xl text-gray-300 mb-3"></i>
                                    <p class="mb-2 text-sm text-gray-600">
                                        <span class="font-semibold text-gray-500">เลือกรูปปก (ไม่บังคับ)</span>
                                    </p>
                                    <p class="text-xs text-gray-500">JPG, PNG, WEBP (สูงสุด 2MB)</p>
                                </div>
                            </label>
                        </div>
                        @error('thumbnail')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-4">
                <a href="{{ route('typing.admin.templates.index') }}"
                    class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                    ยกเลิก
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-violet-600 to-purple-600 hover:from-violet-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>อัปโหลดเอกสาร</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateFileName(input, targetId) {
            const target = document.getElementById(targetId);
            if (input.files && input.files[0]) {
                target.textContent = input.files[0].name;
                target.classList.remove('hidden');
            }
        }

        function previewThumbnail(input) {
            const preview = document.getElementById('thumbnail-preview');
            const previewContainer = document.getElementById('thumbnail-preview-container');
            const placeholder = document.getElementById('thumbnail-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</x-typing-app>