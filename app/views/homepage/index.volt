{% extends 'layouts/main.volt' %}

{# page title #}
{% block title %}SpreadShare - Community curated Tables{% endblock %}

{# page header #}
{% block header %}{% endblock %}

{# main section #}
{% block content %}
{# hero #}
<div class="main__hero">
  <p>Collaborate with and get rewarded by the community</p>
  <h2>A marketplace for community-curated tables in the blockchain</h2>
</div>
{# content #}
<div class="main__content">
  {# tables content #}
  <div class="main__content__tables">
    {# filters #}
    <div class="main__content__tables__filters">
      <div class="main__content__tables__filters__left">
        <li>Today</li>
        <img src="/assets/icons/chevron-down.svg" />
      </div>
      <div class="main__content__tables__filters__right">
        <img src="/assets/icons/clock.svg" />
        <li class="{% if order is 'newly-added' %}selected{% endif %}"><a href="/tables/newly-added">Newly Added</a></li>
        <img src="/assets/icons/upvote.svg" />
        <li class="{% if order is 'most-upvoted' %}selected{% endif %}"><a href="/tables/most-upvoted">Most Upvoted</a></li>
        <img src="/assets/icons/eye.svg" />
        <li class="{% if order is 'most-viewed' %}selected{% endif %}"><a href="/tables/most-viewed">Most Viewed</a></li>
        <img src="/assets/icons/comment.svg" />
        <li class="{% if order is 'most-contributed' %}selected{% endif %}"><a href="/tables/most-contributed">Most Contributed</a></li>
      </div>
    </div>

    {# cards #}
    <div class="tables__content__main__cards">
      {% for table in tables %}
      {{ partial('partials/table') }}
      {% endfor %}
    </div>

  </div>
  {# sidebar #}
  <div class="main__content__sidebar">
    <div class="main__content__sidebar__option">
      <a>Categories</a><img src="/assets/icons/chevron-down.svg" />
    </div>
    <div class="main__content__sidebar__option">
      <a>Table Type</a><img src="/assets/icons/chevron-down.svg" />
    </div>
    <div class="main__content__sidebar__option">
      <a>Tags</a><img src="/assets/icons/chevron-down.svg" />
    </div>
    <div class="main__content__sidebar__option">
      <a>Geography</a><img src="/assets/icons/chevron-down.svg" />
    </div>
  </div>
</div>
{% endblock %}