<div id="person_index" data-role="page" data-theme="a">
    <?php include_partial('global/header', array('title' => 'Person')) ?>
    <div data-role="content">
        <form action="<?php echo url_for('person/search') ?>" method="GET">
            <select name="region" data-theme="a">
                <option value="0">
                    Region
                </option>
                <?php foreach(sfConfig::get('app_country_id') as $key => $country): ?>
                    <option value="<?php echo $country['id'] ?>"><?php echo $key ?></option>
                <?php endforeach ?>
            </select>
            <input type="search" name="keyword" value="" data-prevent-focus-zoom="true" data-theme="a" minlength="3" placeholder="Search Word" />
            <fieldset data-role="controlgroup" data-type="horizontal" data-role="fieldcontain">
                <input id="name" name="type" value="0" type="radio" data-theme="a" checked>
                <label for="name">
                    Name
                </label>
                <input id="wcaid" name="type" value="1" type="radio" data-theme="a">
                <label for="wcaid">
                    WCA&nbsp;ID
                </label>
            </fieldset>
            <button class="search" name="search" type="submit" id="submit" data-theme="a" data-icon="check" data-iconpos="left">Search</button>
        </form>
    <div>
    <?php include_partial('global/footer', array('person_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
