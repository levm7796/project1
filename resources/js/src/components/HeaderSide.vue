<template>
  <div class="header">
    <div class="header_container">
      <div class="header_body">
        <router-link to="login" class="header_but linkWithoutDec" style="margin-right: 7px">Log In</router-link>
        <router-link to="register" class="header_but linkWithoutDec">Sign Up</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HeaderSite",
  props: {
    message: String
  }
}
</script>

<style scoped lang="less">
.linkWithoutDec {
  text-decoration: none;
  color: black;
}
.header {
  //padding: 5px;
  background-color: #42b983;
  //display: flex;
  //justify-content: end;
  //height: 30px;
  //font-size: calc(1470px * (100vw - 320px) / 880);
  &_body {
    padding: calc(20px  + (50 - 20) * ((1vw - 320px) / (1200 - 320)));
    display: flex;
    justify-content: end;
  }
  &_container {
    padding: 0 15px;
    margin: 0 auto;

  }
  &_but {
    padding: calc(20px + (50 - 20) * ((1vw - 420px) / (1200 - 320)));
    font-size: 16px;
    line-height: 150%;
    border: 1px solid black;
  }
}
</style>