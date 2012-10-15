<div id="index" data-role="page" data-theme="a">
    <?php include_partial('global/header', array('title' => 'Competition')) ?>
    <div data-role="content">
        <form action="<?php echo url_for('competition/list') ?>" method="GET">
            <select name="eventId" id="event" data-theme="a">
                <option value="All">
                    Event
                </option>
                <option value="All">All</option>
                <?php foreach(sfConfig::get('app_event_id') as $key => $event): ?>
                    <option value="<?php echo $key ?>"><?php echo $event['cellname'] ?></option>
                <?php endforeach ?>
            </select>
            <select name="region" data-theme="a">
                <option value="World">
                    Region
                </option>
                <option value="World">World</option>
                <?php foreach(sfConfig::get('app_name_continents') as $key => $continent): ?>
                    <option value="<?php echo $continent ?>"><?php echo $continent ?></option>
                <?php endforeach ?>
                <?php foreach(sfConfig::get('app_country_id') as $key => $country): ?>
                    <option value="<?php echo $country['id'] ?>"><?php echo $key ?></option>
                <?php endforeach ?>
            </select>
            <select name="years" data-theme="a">
                <option value="Current">
                    Years
                </option>
                <option value="All">All</option>
                <option value="Current">Current</option>
                <?php for($year = sfConfig::get('app_now_year'); $year >= sfConfig::get('app_recently_old_year'); $year--): ?>
                    <option value="<?php echo $year ?>">Only <?php echo $year ?></option>
                <?php endfor ?>
                <option value="<?php echo sfConfig::get('app_most_old_year') ?>">Only <?php echo sfConfig::get('app_most_old_year') ?></option>
                <?php for($year = sfConfig::get('app_now_year'); $year >= sfConfig::get('app_recently_old_year'); $year--): ?>
                    <option value="<?php echo sfConfig::get('app_most_old_year') . '-' . $year ?>">Until <?php echo $year ?></option>
                <?php endfor ?>
                <option value="<?php echo sfConfig::get('app_most_old_year') ?>">Until <?php echo sfConfig::get('app_most_old_year') ?></option>
            </select>
            <input type="search" name="keyword" value="" data-prevent-focus-zoom="true" data-theme="a" />
            <button class="search" name="search" type="submit" data-theme="a" data-icon="check" data-iconpos="left">Search</button>
        </form>
    </div>
    <?php include_partial('global/footer', array('competition_class' => 'ui-btn-active ui-state-persist')) ?>
</div>
