<p id="commentsCount">Comments <span>{{ commentsCount }}</span></p>
<div class="tableAbout__comments">
  <div class="tableAbout__comments__content">
    {% for comment in comments %}
    {{ partial('table/detail/comment') }}

    <div class="tableAbout__comments__content__subcomments">
      {% for comment in comment['childs'] %}
      {{ partial('table/detail/subcomment') }}
      {% endfor %}
    </div>
    {% endfor %}

    {% if auth.loggedIn() %}
    <div class="tableAbout__comments__content__send">
      <form method="POST" action="/table/{{ table['id'] }}/about">
        <input type="hidden" name="parentId" id="commentParentId" value="" />
        <input name="comment" id="commentTextArea" placeholder="Add a comment" />
        <button>Send</button>
      </form>
    </div>
    {% endif %}
  </div>
</div>