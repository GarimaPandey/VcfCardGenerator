@extends('app')

<template id="center">
    <div class="user-card">
        <div class="user-card-header-info">
            <div class="user-card-header">
                <img :src="user.mug" alt="User Mugshot" />
                <h1><b>{{ user.first_name }}    {{ user.last_name }}</b> </h1>
                </div><div>
                      </div>
        </div>
        <div>
            <div class="user-card-body">
            <div class="svg">
                <p>
                <div class="actionsC">
                <div class="actionBtn">
                <a :href="'tel:' + user.phone" target="_blank" rel="noopener noreferrer" aria-label="Mobile" style="background-color: rgb(14, 14, 14);"><div class="icon action"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 216 216"><path d="M103.57 180.73h8.87v8.87h-8.87v-8.87zm-31.8-67.01c1.07.62 2.25.94 3.41.94 2.25 0 4.47-1.14 5.72-3.24l35.48-59.43c1.87-3.16.85-7.24-2.3-9.12a6.64 6.64 0 00-9.13 2.3L69.47 104.6a6.668 6.668 0 002.3 9.12zm98.32-85.56v159.67c0 14.68-11.94 26.61-26.61 26.61H72.52c-14.68 0-26.61-11.94-26.61-26.61V28.16c0-14.67 11.94-26.61 26.61-26.61h70.96c14.68 0 26.61 11.94 26.61 26.61zm-75.4-8.87c0 2.45 1.99 4.44 4.44 4.44h17.74c2.44 0 4.43-1.98 4.43-4.44s-1.99-4.43-4.43-4.43H99.13c-2.44 0-4.44 1.98-4.44 4.43zm26.62 157.01c0-2.44-1.99-4.43-4.43-4.43H99.13c-2.44 0-4.44 1.99-4.44 4.43v17.74a4.44 4.44 0 004.44 4.43h17.74c2.44 0 4.43-1.99 4.43-4.43V176.3h.01zm31.04-139.26h-88.7v124.19h88.71l-.01-124.19zM71.84 75.61c1.06.61 2.2.9 3.35.9 2.29 0 4.5-1.19 5.75-3.3l12.41-21.29a6.658 6.658 0 00-11.5-6.71l-12.42 21.3a6.653 6.653 0 002.41 9.1z" fill="#fff"></path></svg></div></a>
                </div>
                </div>
                </p>
              </div>
            <div class="svg">
              <p>
                <div class="actionsC">
                <div class="actionBtn">
                <a :href="'mailto:' + user.email" target="_blank" rel="noopener noreferrer" aria-label="email" style="background-color: rgb(14, 14, 14);">
                <div class="icon action"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><path d="M22 6l-10 7L2 6"></path></svg></div></a> 
                </div>
                </div>
                </p>
              </div>
              <div class="svg">
                <div class="qr">
                    <qrcode :value="'http://127.0.0.1:8000/agent/' + user.first_name + user.last_name" />
                </div>
              </div>
              <div class="svg">
               <button class="btn btn-primary" @click="downloadVcf()">
                Save Contact
            </button>

              </div>

            </div>
        </div>
    </div>
</template>

<script>
import Qrcode from "vue-qrcode";

export default {
    components: {
        Qrcode,
    },
  
    props: {
        user: Array,
    },
    methods: {
        downloadVcf() {
            const vcfContent = `BEGIN:VCARD
                VERSION:3.0
                CHARSET:UTF-8
                FN:${this.user.first_name} ${this.user.last_name}
                TEL;TYPE=cell:${this.user.phone}
                EMAIL:${this.user.email}
                CATEGORIES:${this.user.roles.join(",")}
                END:VCARD`;

            const blob = new Blob([vcfContent], { type: "text/vcard" });
            const url = window.URL.createObjectURL(blob);

            const link = document.createElement("a");
            link.href = url;
            link.setAttribute(
                "download",
                `${this.user.first_name}_${this.user.last_name}.vcf`
            );
            link.click();

            window.URL.revokeObjectURL(url);
        },
        showVcf() {
            this.vcfVisible = true;
        },
    },
};
</script>
<style>
html {
    background: rgb(207, 69, 32);
    width:30%; /* Set the width of the div */
    margin: 0 auto;
}

body {
    padding-top: 100px;
    font-family: sans-serif;
}

h1{
font-size:60px;
}
button {
    background-color: black;
    color: white;
    width: 180px;
    height: 50px;
    border-radius: 30px;
    align-items:center;
    margin-left:20px;
}

template {
    width: 50%; /* Set the width of the div */
    margin: 0 auto;
}

.qr{
height:70px;
width:70px;
}


.svg{
display:inline-block;
width: 80px;
height: 80px;
padding:10px;
}

.actionsC
{
background-color:black;
width:60px;
height:60px;
border-radius:20px;
align-items:center;
padding:18px;
}
.user-card {
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    width: 350px;
    height: 370px;
}

.user-card-header {
    display: flex;
    align-items: center;
    background-color: #f5f5f5;
    padding: 30px;
}

.user-card-header img {
    display: flex;
    align-items: center;
    border-radius: 50%;
    height: 130px;
    margin-right: 10px;
    width: 130px;
}

.user-card-header-info h1 {
    font-size: 24px;
    margin: 0;
}

.user-card-header-info p {
    color: black;
    font-size: 18px;
    margin: 0;
}

.user-card-body {
    padding: 10px;
    background-color: #f5f5f5;
    align-items: center;
    padding-left: 50px;
}

.user-card-body p {
    font-size: 16px;
    margin: 5px 0;
    background-color: #f5f5f5;
}

</style>
