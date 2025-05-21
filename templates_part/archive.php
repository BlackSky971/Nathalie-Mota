

<form method="GET">
    <label for="categorie">Catégorie :</label>
    <select name="categorie">
        <option value="">Toutes</option>
        <?php
        $categories = get_terms(['taxonomy' => 'category', 'hide_empty' => false]);
        foreach ($categories as $cat) {
            echo '<option value="' . $cat->slug . '">' . $cat->name . '</option>';
        }
        ?>
    </select>

    <label for="format">Format :</label>
    <select name="format">
        <option value="">Tous</option>
        <option value="paysage">Paysage</option>
        <option value="portrait">Portrait</option>
    </select>

    <label for="tri">Trier par :</label>
    <select name="tri">
        <option value="recent">Plus récentes</option>
        <option value="ancien">Plus anciennes</option>
    </select>

    <button type="submit">Filtrer</button>
</form>
