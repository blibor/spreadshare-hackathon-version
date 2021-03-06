{% extends 'layouts/main.volt' %}

{% block header %}
{% endblock %}

{% block content %}
<div class="layout">
  <div class="layout__content">
    <div class="layout__content__wrapper">
      <p class="layout__content__title">Account</p>
      <p class="layout__content__subtitle">Manage everything related to your account, profile, wallet and tokens here.</p>
      <div class="layout__content__main layout__content__main__wallet">
        {% if tableTokens %}
        <div class="layout__content__main__wallet__stats">
          <div class="layout__content__main__wallet__column">
            <div class="layout__content__main__wallet__stats__text">
              <p>Your token overview</p>
            </div>
            <div class="layout__content__main__wallet__stats__data">
              <p>{{ wallet.tokens }}</p>
              <p><span class="up-arrow-icon">⬆</span><i>0%</i> <span>(to last week)<span></p>
            </div>
          </div>
        </div>
        <div class="layout__content__main__wallet__tables">
          <div class="layout__content__main__wallet__column">
            <div class="layout__content__main__wallet__tables__text">
              <p>Your earned tokens</p>
            </div>
            <div class="layout__content__main__wallet__tables__titles">
              <div>
                <p>Table name</p>
              </div>
              <div>
                <p>Your role</p>
                <img src="/assets/icons/sort.svg" />
              </div>
              <!--
              <div>
                <p>% Ownership</p>
                <img src="/assets/icons/sort.svg" />
              </div>
                -->
              <div>
                <p>Tokens earned</p>
                <img src="/assets/icons/sort.svg" />
              </div>
            </div>
            <div class="layout__content__main__wallet__tables__cells">
              {% for tokens in tableTokens %}
              <div class="layout__content__main__wallet__tables__cells__item">
                <div>{{ tokens['tableTitle'] }}</div>
                <div>{% if tokens['ownerUserId'] == auth.getUserId() %}Owner{% else %}Contributor{% endif %}</div>
                <!--
                <div>
                {{ tokens['ownership'] }}%
                </div>
                -->
                <div>{{ tokens['tokensEarned'] }}</div>
              </div>
              {% endfor %}
            </div>
          </div>
        </div>
        {% else %}
        <div class="tables__content__main__cards__item center" style="padding:40px;">
          <div>
            <img src="/assets/images/boombox.png" alt="" />
            <p>You haven't contributed anything so you unfortunately didn't earn any tokens, yet.</p>
            <p><a href="/table/add">Create a Table</a></p>
          </div>
        </div>
        {% endif %}
      </div>
    </div>
    <aside class="aside aside--settings">
      <a href="/settings/personal">
        <div class="aside__item"><p>Personal</p></div>
      </a>
      <a href="/settings/account">
        <div class="aside__item"><p>Account</p></div>
      </a>
      <a href="/settings/notifications">
        <div class="aside__item"><p>Notifications</p></div>
      </a>
      <a href="/settings/connected">
        <div class="aside__item"><p>Connect Accounts</p></div>
      </a>
      <a href="/settings/wallet">
        <div class="aside__item item-selected"><p>Wallet</p></div>
      </a>
      <a href="/settings/invite">
        <div class="aside__item"><p>Invite</p></div>
      </a>
    </aside>
  </div>
</div>
{% endblock %}
