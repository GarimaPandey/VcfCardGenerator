
@extends('app')

<template id="cc">
  <div class="user-card">
    <div class="user-card-header">
      <img :src="user.mug" alt="User Mugshot" />
      <div class="user-card-header-info">
        <h1>{{ user.first_name }} {{ user.last_name }}</h1>
        <p>{{ user.circle }}</p>
      </div>
    </div>
    <div class="user-card-body">
      <p>Email: {{ user.email }}</p>
      <p>Phone: {{ user.phone }}</p>
      <p>Roles: {{ user.roles.join(', ') }}</p>
    </div>
    <div class="user-card-footer">
      <button class="btn btn-primary" @click="downloadVcf()">Download VCF</button>
    </div>
  </div>

</template>

<script>
   export default {
        props: {
            user: Array
        },
        methods: {
            downloadVcf() {
            const vcfContent = `
                BEGIN:VCARD
                VERSION:3.0
                FN:${this.user.first_name} ${this.user.last_name}
                TEL:${this.user.phone}
                EMAIL:${this.user.email}
                CATEGORIES:${this.user.roles.join(',')}
                END:VCARD
                `;
            const blob = new Blob([vcfContent], { type: 'text/vcard' });
            const url = window.URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = `${this.user.first_name}_${this.user.last_name}.vcf`;
            link.click();
            window.URL.revokeObjectURL(url);
            },
            showVcf() {
                    this.vcfVisible = true;
            },
  },
    }
</script>
<style>

.user-card {
  border: 1px solid #ccc;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  width: 300px;
}

.user-card-header {
  display: flex;
  align-items: center;
  background-color: #f5f5f5;
  padding: 10px;
}

.user-card-header img {
  border-radius: 50%;
  height: 80px;
  margin-right: 10px;
  width: 80px;
}

.user-card-header-info h1 {
  font-size: 24px;
  margin: 0;
}

.user-card-header-info p {
  color: #666;
  font-size: 18px;
  margin: 0;
}

.user-card-body {
  padding: 10px;
}

.user-card-body p {
  font-size: 16px;
  margin: 5px 0;
}
</style>