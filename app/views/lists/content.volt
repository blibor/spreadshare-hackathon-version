{% for table in tables %}
<tr>
  <td>
    {% if isAjax %}
    <input class="moreToLoad" type="hidden" value="{{ moreToLoad }}" />{% endif %}
    <div class="{{ table['flags'] === '2' ? 're-table-green' : '' }}">{{ table['flags'] === '2' ? 'PUBLISHED' : 'DRAFT' }}</div>


    <a href="/stream/{{ table['id'] }}">
      <span style="display: flex;">
        <h3>{{ table['title'] }}</h3>&nbsp;&nbsp;&nbsp;
        <span class="list-card__subscriberCount u-flex u-flexAlignItemsCenter">
          <img height="22px" src="/assets/images/9-0/list-card-subscriber-bird.svg"> {{ table['subscriberCount'] }}
        </span>
    </a>

    </span>

    <p>{{ table['tagline'] }}</p>
  </td>
  <td>
    <div class="u-flex u-flexJustifyCenter u-flexAlignItemsCenter card-actions-button l-button">
      <img src="/assets/images/arrow-down.svg" />
    </div>
    <div class="sh-dropdown card-actions-dropdown u-flex u-flexCol l-dropdown">
      <a href="/stream/{{ table['id'] }}/edit">
        <img src="/assets/images/pencil2.svg" /> Edit List</a>

      <a href="/stream/{{ table['id'] }}/delete" class="warning-color">
        <img src="/assets/images/bin3.svg" /> Delete List</a>

    </div>
  </td>
</tr>
<tr class="re-table-space"></tr>
{% endfor %}
