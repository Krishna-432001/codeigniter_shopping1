<?= $this->extend('frontend/layout/app') ?>

<?= $this->section('title') ?>
    Categories
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Select a Category</h2>

    <!-- Display flash messages -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="/submit-category" method="post">
        @csrf
        <div class="form-group">
            <label for="category">Choose a category:</label>
            <select id="category" name="category" required>
                <option value="">-- Select a Category --</option>
                <?php if (!empty($categories) && is_array($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= esc($category['id']) ?>"><?= esc($category['name']) ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No categories found</option>
                <?php endif; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<style>
    .form-group {
        margin-bottom: 15px;
    }
</style>

<?= $this->endSection() ?>
