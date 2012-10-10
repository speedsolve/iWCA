<div data-role="page" id="page1">
    <div data-theme="a" data-role="header">
        <h3>
            Ranking
        </h3>
    </div>
    <div data-role="content">
        <form action="" method="POST">
            <label for="selectmenu1">
            </label>
            <select name="event" data-theme="a" data-overlay-theme="b" data-native-menu="false">
                <option value="333">
                    Event
                </option>
                <?php foreach(sfConfig::get('app_event_id') as $key => $event): ?>
                    <option value="<?php echo $key ?>"><?php echo $event['cellname'] ?></option>
                <?php endforeach ?>
            </select>
            <label for="selectmenu2">
            </label>
            <select name="region" data-theme="a" data-overlay-theme="b" data-native-menu="false">
                <option value="World">
                    Region
                </option>
                <option value="">&nbsp;</option>
                <option value="World">World</option>
                <option value="">&nbsp;</option>
                <?php foreach(sfConfig::get('app_name_continents') as $key => $continent): ?>
                    <option value="<?php echo $continent ?>"><?php echo $continent ?></option>
                <?php endforeach ?>
                <option value="">&nbsp;</option>
                <?php foreach(sfConfig::get('app_country_id') as $key => $country): ?>
                    <option value="<?php echo $key ?>"><?php echo $key?></option>
                <?php endforeach ?>
            </select>
            <label for="selectmenu3">
            </label>
            <select name="years" data-theme="a" data-overlay-theme="b" data-native-menu="false">
                <option value="All">
                    Years
                </option>
                <option value="">&nbsp;</option>
                <option value="All">All</option>
                <option value="">&nbsp;</option>
                <option value="Only <?php echo sfConfig::get('app_most_old_year') ?>">Only <?php echo sfConfig::get('app_most_old_year') ?></option>
                <?php for($year = sfConfig::get('app_recently_old_year'); $year <= sfConfig::get('app_now_year'); $year++): ?>
                    <option value="Only <?php echo $year ?>">Only <?php echo $year ?></option>
                <?php endfor ?>
                <option value="">&nbsp;</option>
                <option value="Until <?php echo sfConfig::get('app_most_old_year') ?>">Until <?php echo sfConfig::get('app_most_old_year') ?></option>
                <?php for($year = sfConfig::get('app_recently_old_year'); $year <= sfConfig::get('app_now_year'); $year++): ?>
                    <option value="Until <?php echo $year ?>">Until <?php echo $year ?></option>
                <?php endfor ?>
            </select>
            <label for="selectmenu4">
            </label>
            <select name="gender" data-theme="a" data-overlay-theme="b" data-native-menu="false">
                <option value="All">
                    Gender
                </option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <fieldset data-role="controlgroup" data-type="horizontal" data-role="fieldcontain" align="center">
                <input id="radio1" name="type" value="person" type="radio" data-theme="a" checked>
                <label for="radio1">
                    Person
                </label>
                <input id="radio2" name="type" value="result" type="radio" data-theme="a">
                <label for="radio2">
                    Result
                </label>
                <input id="radio3" name="type" value="region" type="radio" data-theme="a" disabled>
                <label for="radio3">
                    Region
                </label>
            </fieldset>
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><button name="single"  action="<?php echo url_for('ranking/single') ?>" type="submit" data-theme="a" data-icon="check" data-iconpos="left">Single</button></div>
                <div class="ui-block-b"><button name="average" action="<?php echo url_for('ranking/average') ?>" type="submit" data-theme="a" data-icon="check" data-iconpos="left">Average</button></div>
            </fieldset>
            <?php include_partial('global/footer', array('ranking_class' => 'ui-btn-active ui-state-persist')) ?>
        </form>
    </div>
</div>
