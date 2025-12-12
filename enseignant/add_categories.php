<head>
    <link rel="stylesheet" href="../css/categories.css">
</head>
<div id="categoriesModal" class="modal">
    <div class="modal-content">
        <div class="modal-body">
            <div class="modal-header">
                <h3>New Category</h3>
                <button id="closeBtn" class="close-btn">&times;</button>
            </div>
            <form>
                <div class="form-group">
                    <label>Category name</label>
                    <input type="text" name="nom" required placeholder="Ex: HTML/CSS">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" placeholder="Describe this category..."></textarea>
                </div>

                <div class="form-actions">
                    <button id="cancelBtn" type="button">Annuler</button>
                    <button id="submitBtn" type="submit">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>
