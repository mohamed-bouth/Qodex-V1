<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Quiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* CSS Reset & Base Styles 
           محاكاة أساسيات Tailwind
        */
        * {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb;
        }
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, sans-serif;
            margin: 0;
            background-color: #f3f4f6; /* خلفية رمادية خفيفة للصفحة */
        }
        button, input, select, textarea {
            font-family: inherit;
            font-size: 100%;
            margin: 0;
            padding: 0;
        }
        button {
            cursor: pointer;
            background-color: transparent;
            background-image: none;
        }

        /* تحويل كلاسات Tailwind إلى CSS عادي
        */
        
        /* Layout & Display */
        .hidden { display: none; }
        .block { display: block; }
        .flex { display: flex; }
        .grid { display: grid; }
        .fixed { position: fixed; }
        .inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
        .z-50 { z-index: 50; }
        .w-full { width: 100%; }
        .max-w-4xl { max-width: 56rem; }
        .max-h-\[90vh\] { max-height: 90vh; }
        .overflow-y-auto { overflow-y: auto; }
        
        /* Flexbox Utilities */
        .items-center { align-items: center; }
        .justify-center { justify-content: center; }
        .justify-between { justify-content: space-between; }
        .flex-1 { flex: 1 1 0%; }
        
        /* Grid Utilities */
        /* ملاحظة: النقطتان : في اسم الكلاس يجب وضع شرطة مائلة قبلها في CSS */
        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        
        /* Spacing (Margin & Padding) */
        .p-6 { padding: 1.5rem; }
        .p-4 { padding: 1rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        
        .m-0 { margin: 0; }
        .mx-4 { margin-left: 1rem; margin-right: 1rem; }
        .my-6 { margin-top: 1.5rem; margin-bottom: 1.5rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-3 { margin-bottom: 0.75rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mr-2 { margin-right: 0.5rem; }
        
        .gap-4 { gap: 1rem; }
        .gap-3 { gap: 0.75rem; }
        
        /* Backgrounds */
        .bg-black { background-color: #000; }
        /* دمجنا الشفافية هنا لأن Tailwind يستخدم متغيرات */
        .bg-black.bg-opacity-50 { background-color: rgba(0, 0, 0, 0.5); } 
        
        .bg-white { background-color: #ffffff; }
        .bg-gray-50 { background-color: #f9fafb; }
        .bg-indigo-600 { background-color: #4f46e5; }
        .bg-green-600 { background-color: #16a34a; }
        
        /* Hover States */
        .hover\:bg-gray-50:hover { background-color: #f9fafb; }
        .hover\:bg-gray-600:hover { color: #4b5563; }
        .hover\:bg-indigo-700:hover { background-color: #4338ca; }
        .hover\:bg-green-700:hover { background-color: #15803d; }
        .hover\:text-red-700:hover { color: #b91c1c; }
        
        /* Typography */
        .text-2xl { font-size: 1.5rem; line-height: 2rem; }
        .text-xl { font-size: 1.25rem; line-height: 1.75rem; }
        .text-sm { font-size: 0.875rem; line-height: 1.25rem; }
        
        .font-bold { font-weight: 700; }
        
        .text-white { color: #ffffff; }
        .text-gray-900 { color: #111827; }
        .text-gray-700 { color: #374151; }
        .text-gray-400 { color: #9ca3af; }
        .text-red-600 { color: #dc2626; }
        
        /* Borders & Radius */
        .border { border-width: 1px; }
        .border-gray-300 { border-color: #d1d5db; }
        .rounded-xl { border-radius: 0.75rem; }
        .rounded-lg { border-radius: 0.5rem; }
        
        /* Effects (Shadow & Transition) */
        .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }
        .transition { transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform; transition-duration: 150ms; }
        
        /* Form Elements specific */
        textarea { resize: vertical; }
        
        /* Focus Rings (محاكاة تأثير الفوكس) */
        .focus\:ring-2:focus {
            outline: 2px solid transparent;
            outline-offset: 2px;
            box-shadow: 0 0 0 2px #fff, 0 0 0 4px #6366f1; /* Indigo ring */
            border-color: transparent;
        }

        /* تنسيق الخط الفاصل hr */
        hr { border-top-width: 1px; }

    </style>
</head>
<body>

    <div id="createQuizModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Créer un Quiz</h3>
                    <button onclick="closeModal('createQuizModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form>
                    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                    
                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Titre du quiz *
                            </label>
                            <input type="text" name="titre" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Ex: Les Bases de HTML5">
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Catégorie *
                            </label>
                            <select name="categorie_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="">Sélectionner une catégorie</option>
                                <option value="1">HTML/CSS</option>
                                <option value="2">JavaScript</option>
                                <option value="3">PHP/MySQL</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Description
                        </label>
                        <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Décrivez votre quiz..."></textarea>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-xl font-bold text-gray-900">Questions</h4>
                            <button type="button" onclick="addQuestion()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm">
                                <i class="fas fa-plus mr-2"></i>Ajouter une question
                            </button>
                        </div>

                        <div id="questionsContainer">
                            <div class="bg-gray-50 rounded-lg p-4 mb-4 question-block">
                                <div class="flex justify-between items-center mb-4">
                                    <h5 class="font-bold text-gray-900">Question 1</h5>
                                    <button type="button" onclick="removeQuestion(this)" class="text-red-600 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Question *</label>
                                    <input type="text" name="questions[0][question]" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Posez votre question...">
                                </div>

                                <div class="grid md:grid-cols-2 gap-3 mb-3">
                                    <div>
                                        <label class="block text-gray-700 text-sm mb-2">Option 1 *</label>
                                        <input type="text" name="questions[0][option1]" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm mb-2">Option 2 *</label>
                                        <input type="text" name="questions[0][option2]" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm mb-2">Option 3 *</label>
                                        <input type="text" name="questions[0][option3]" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 text-sm mb-2">Option 4 *</label>
                                        <input type="text" name="questions[0][option4]" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Réponse correcte *</label>
                                    <select name="questions[0][correct]" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        <option value="">Sélectionner la bonne réponse</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="closeModal('createQuizModal')" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Annuler
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-check mr-2"></i>Créer le Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        
        // دوال وهمية لمنع الأخطاء عند الضغط على الأزرار
        function addQuestion() { console.log('Add Question Clicked'); }
        function removeQuestion(btn) { console.log('Remove Question Clicked'); }
    </script>
</body>
</html>