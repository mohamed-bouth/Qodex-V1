                    <?php
                    $oldQuestions = $_SESSION['questions_data'] ?? [];
                    
                    foreach ($oldQuestions as $index => $data): 
                        // إلا كان الـ index هو 0، نقزو وسير للي موراه
                        if ($index === 0) continue; 
                        $displayCount = $index + 1;
                    ?>
                        <div class="question-card">
                            <div class="card-header">
                                <h5 class="question-number">Question <?= $displayCount ?></h5>
                                <button type="button" class="btn-icon-danger delete-btn">
                                Delete
                                </button>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Question *</label>
                                <input type="text" name="questions[<?= $index ?>][question]" 
                                    value="<?= htmlspecialchars($data['question'] ?? '') ?>" 
                                    class="form-input" placeholder="Posez votre question...">
                            </div>

                            <div class="options-grid">
                                <div class="form-group">
                                    <label class="form-label-sm">Option 1 *</label>
                                    <input type="text" name="questions[<?= $index ?>][option1]" 
                                        value="<?= htmlspecialchars($data['option1'] ?? '') ?>" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label-sm">Option 2 *</label>
                                    <input type="text" name="questions[<?= $index ?>][option2]" 
                                        value="<?= htmlspecialchars($data['option2'] ?? '') ?>" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label-sm">Option 3 *</label>
                                    <input type="text" name="questions[<?= $index ?>][option3]" 
                                        value="<?= htmlspecialchars($data['option3'] ?? '') ?>" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label-sm">Option 4 *</label>
                                    <input type="text" name="questions[<?= $index ?>][option4]" 
                                        value="<?= htmlspecialchars($data['option4'] ?? '') ?>" class="form-input">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Réponse correcte *</label>
                                <select name="questions[<?= $index ?>][correct]" class="form-input">
                                    <option value="">Sélectionner la bonne réponse</option>
                                    <option value="1" <?= ($data['correct'] ?? '') == 1 ? 'selected' : '' ?>>Option 1</option>
                                    <option value="2" <?= ($data['correct'] ?? '') == 2 ? 'selected' : '' ?>>Option 2</option>
                                    <option value="3" <?= ($data['correct'] ?? '') == 3 ? 'selected' : '' ?>>Option 3</option>
                                    <option value="4" <?= ($data['correct'] ?? '') == 4 ? 'selected' : '' ?>>Option 4</option>
                                </select>
                            </div>
                        </div>
                    <?php endforeach; ?>