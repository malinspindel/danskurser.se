

<section class="search-filter">
  <div class="row wrapper">
    <?php echo do_shortcode( '[course_search]' ); ?>
  </div>
</section>

<section class="search-filter">
  <div class="row wrapper">
    <form id="second-search-filter" method="get">

      <h2>Vilken / Vilka dansstilar söker du?</h2>
      <div class="search-filter-part column medium-3">
        <input type="checkbox" name="weekdays" value="Monday">Alla Dansstilar<br>
        <input type="checkbox" name="weekdays" value="Tuesday">Dansstil<br>
        <input type="checkbox" name="weekdays" value="Wednesday">Dansstil<br>
        <input type="checkbox" name="weekdays" value="Thursday"> Dansstil<br>
        <input type="checkbox" name="weekdays" value="Friday">Dansstil<br>
      </div>

      <div class="search-filter-part column medium-3">
        <input type="checkbox" name="levels" value="Level1"> Dansstil<br>
        <input type="checkbox" name="levels" value="Level2"> Dansstil<br>
        <input type="checkbox" name="levels" value="Level3"> Dansstil<br>
        <input type="checkbox" name="levels" value="Level4"> Dansstil<br>
        <input type="checkbox" name="levels" value="Level5"> Dansstil<br>
      </div>

      <div class="search-filter-part column medium-3">
        <input type="checkbox" name="Ages" value="All"> Dansstil<br>
        <input type="checkbox" name="Ages" value="One">Dansstil<br>
        <input type="checkbox" name="Ages" value="Two">Dansstil<br>
        <input type="checkbox" name="Ages" value="Three">Dansstil<br>
        <input type="checkbox" name="Ages" value="Four"> Dansstil<br>
      </div>

      <div class="search-filter-part column medium-3">
        <input type="checkbox" name="Ages" value="All"> Dansstil<br>
        <input type="checkbox" name="Ages" value="One">Dansstil<br>
        <input type="checkbox" name="Ages" value="Two">Dansstil<br>
        <input type="checkbox" name="Ages" value="Three">Dansstil<br>
        <input type="checkbox" name="Ages" value="Four"> Dansstil<br>
      </div>

      <div class="info">
        <p>
          Välj en eller flera val. Lämna tomt om du önskar se alla.
        </p>
      </div>
    </form>
  </div>

</section>
