<div data-role="page">
    <?php include_partial('global/header', array('title' => 'Record')) ?>
    <div data-role="content">
        <form action="" method="GET">
            <select name="eventId" id="event" data-theme="a">
                <option value="333">
                    Event
                </option>
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
                <option value="0">
                    Years
                </option>
                <option value="0">All</option>
                <?php for($year = sfConfig::get('app_now_year'); $year >= sfConfig::get('app_recently_old_year'); $year--): ?>
                    <option value="<?php echo $year ?>">Only <?php echo $year ?></option>
                <?php endfor ?>
                <option value="<?php echo sfConfig::get('app_most_old_year') ?>">Only <?php echo sfConfig::get('app_most_old_year') ?></option>
                <?php for($year = sfConfig::get('app_now_year'); $year >= sfConfig::get('app_recently_old_year'); $year--): ?>
                    <option value="<?php echo sfConfig::get('app_most_old_year') . '-' . $year ?>">Until <?php echo $year ?></option>
                <?php endfor ?>
                <option value="<?php echo sfConfig::get('app_most_old_year') ?>">Until <?php echo sfConfig::get('app_most_old_year') ?></option>
            </select>
            <select name="gender" data-theme="a">
                <option value="0">
                    Gender
                </option>
                <option value="">All</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <fieldset data-role="controlgroup" data-type="horizontal" data-role="fieldcontain" align="center">
                <input id="radio1" name="type" value="1" type="radio" data-theme="a" checked>
                <label for="radio1">
                    Current
                </label>
                <input id="radio2" name="type" value="0" type="radio" data-theme="a">
                <label for="radio2">
                    History
                </label>
            </fieldset>
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><button class="single" name="single" action="<?php echo url_for('ranking/single') ?>" type="submit" data-theme="a" data-icon="check" data-iconpos="left">Single</button></div>
                <div class="ui-block-b"><button class="average" name="average" action="<?php echo url_for('ranking/average') ?>" type="submit" data-theme="a" data-icon="check" data-iconpos="left">Average</button></div>
            </fieldset>
            <?php include_partial('global/footer', array('record_class' => 'ui-btn-active ui-state-persist')) ?>
        </form>
    </div>
</div>