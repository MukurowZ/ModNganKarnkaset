<template>
<div style="font-family: Kanit; ">
  <b-navbar toggleable="lg" type="light" style="background-color: #c4e6d2">
    <b-navbar-brand href="/" style="font-weight: 450;">มดงานการเกษตร</b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        <b-nav-item href="/">หน้าหลัก <font-awesome-icon :icon="['fas', 'home']" /></b-nav-item>
        <b-nav-item  href="/product">สินค้า <font-awesome-icon :icon="['fas', 'shopping-bag']" /></b-nav-item>
        <b-nav-item  href="/service">บริการ <font-awesome-icon :icon="['fas', 'hand-holding']" /></b-nav-item>
        <b-nav-item href="/contact">ติดต่อเรา <font-awesome-icon :icon="['fas', 'phone']" /> </b-nav-item>
      </b-navbar-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">
        <!-- <b-nav-form>
          <b-form-input size="sm" class="mr-sm-2" placeholder="พิมพ์เพื่อค้นหา"></b-form-input>
          <b-button size="sm" class="my-2 my-sm-0" type="submit">ค้นหา <font-awesome-icon :icon="['fas', 'search']" /></b-button>
        </b-nav-form> -->

        <b-nav-item-dropdown disabled text="Lang" left>
          <b-dropdown-item href="#">EN</b-dropdown-item>
          <b-dropdown-item href="#">CN</b-dropdown-item>
          <b-dropdown-item href="#">TH</b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template slot="button-content"><em>User</em></template>
          <b-dropdown-item href="#">Profile</b-dropdown-item>
          <b-dropdown-item href="#">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</div>
</template>

<script>
export default {

}
</script>
