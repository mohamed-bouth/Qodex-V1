    <div id="createCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Nouvelle Catégorie</h3>
                    <button onclick="closeModal('createCategoryModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form>
                    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Nom de la catégorie *
                        </label>
                        <input type="text" name="nom" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Ex: HTML/CSS">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Description
                        </label>
                        <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Décrivez cette catégorie..."></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="closeModal('createCategoryModal')" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Annuler
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-check mr-2"></i>Créer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Créer Quiz -->
    <div id="createQuizModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
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

                    <!-- Questions Section -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-xl font-bold text-gray-900">Questions</h4>
                            <button type="button" onclick="addQuestion()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm">
                                <i class="fas fa-plus mr-2"></i>Ajouter une question
                            </button>
                        </div>

                        <div id="questionsContainer">
                            <!-- Question 1 -->
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
    
</script>