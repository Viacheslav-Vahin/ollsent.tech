jQuery(document).ready(function ($) {
      
$('#date_a1').datepicker();
// $('#date_a1').attr('title', '');

let d1 = [0, 10, 5, 0, 15, 11];
let d1a = [0, 5, 2.5, 0, 3, 4];

// console.log(jan,feb,mrt,noy,dek);


$('#myChart').css('display', 'none');
$('#moneyChart').css('display', 'none');
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

$('#ainp').on("change keyup", function () {
    $("#ares0").remove();
    $(".fc8").remove();
    $(".fc9").remove();
    $("canvas#myChart").remove();
    $("canvas#moneyChart").remove();
   
    $("canvas#moneyChart6").remove();
    $("canvas#myChart7").remove();
    $("canvas#c8").remove();
    $("canvas#c9").remove();
    // let currYear = new Date().getFullYear();
    // console.log(currYear);
    if ($('#ayear').val() !=='') {
        $("div.forChart1").append('<canvas id="myChart" width="400" height="100"></canvas>');   
        $("div.forChart1").append('<canvas id="moneyChart" width="400" height="100"></canvas>');
        $("div.forChart1").append(' <div class="fc8"><canvas id="c8"></canvas></div>');
        $("div.forChart1").append(' <div class="fc9"><canvas id="c9"></canvas></div>');
      
        $("div.forChart6").append('<canvas id="moneyChart6"></canvas>');
        $("div.forChart7").append('<canvas id="myChart7"></canvas>');
        
    
      
    $(".aitem").hide().filter(function () {
        let rtnData = "";
        let yearInp = $('#ayear').val();
        let monthInp = $('#amonth').val();
        
        rtnData = (
    
            $(this).attr("data-date2").slice(-4).match(yearInp) &&
            $(this).attr("data-date2").match(monthInp) 
            // $(this).attr("data-spec1").match(regSpec)
        );

    return rtnData;
    }).fadeIn('fast');
    let jan=feb=mrt=apr=may=jun=jul=avg=sen=okt=noy=dek=0;    
    let dekn = $('.aitem[data-date2*="декабр"]:visible').length;
    let noyn = $('.aitem[data-date2*="ноябр"]:visible').length;
    let oktn = $('.aitem[data-date2*="октябр"]:visible').length;
    let senn = $('.aitem[data-date2*="сентябр"]:visible').length;
    let avgn = $('.aitem[data-date2*="август"]:visible').length;
    let juln = $('.aitem[data-date2*="июл"]:visible').length;
    let junn = $('.aitem[data-date2*="июн"]:visible').length;
    let mayn = $('.aitem[data-date2*="мая"]:visible').length;
    let aprn = $('.aitem[data-date2*="апрел"]:visible').length;
    let mrtn = $('.aitem[data-date2*="март"]:visible').length;
    let febn = $('.aitem[data-date2*="феврал"]:visible').length;
    let jann = $('.aitem[data-date2*="январ"]:visible').length;
    // console.log(senn);
    if(dekn > 0){dek =dekn;}
    if(noyn > 0){noy =noyn;}
    if(oktn > 0){okt =oktn;}
    if(senn > 0){sen =senn;}
    if(avgn > 0){avg =avgn;}
    if(juln > 0){jul =juln;}
    if(junn > 0){jun =junn;}
    if(mayn > 0){may =mayn;}
    if(aprn > 0){apr =aprn;}
    if(mrtn > 0){mrt =mrtn;}
    if(febn > 0){feb =febn;}
    if(jann > 0){jan =jann;}
    const d11 = [jan,feb,mrt,apr,may,jun,jul,avg,sen,okt,noy,dek];
// ------------------------ mas1 == may_status1---------------------------------------------------------------
let js1=fs1=mrs1=aps1=mas1=jns1=jls1=avs1=ss1=os1=ns1=ds1=0;
let js1n = $('.aitem[data-status*="Офер"][data-date2*="январ"]:visible').length;
let fs1n = $('.aitem[data-status*="Офер"][data-date2*="феврал"]:visible').length;
let mrs1n = $('.aitem[data-status*="Офер"][data-date2*="март"]:visible').length;
let aps1n = $('.aitem[data-status*="Офер"][data-date2*="апрел"]:visible').length;
let mas1n = $('.aitem[data-status*="Офер"][data-date2*="мая"]:visible').length;
let jns1n = $('.aitem[data-status*="Офер"][data-date2*="июн"]:visible').length;
let jls1n = $('.aitem[data-status*="Офер"][data-date2*="июл"]:visible').length;
let avs1n = $('.aitem[data-status*="Офер"][data-date2*="август"]:visible').length;
let ss1n = $('.aitem[data-status*="Офер"][data-date2*="сентябр"]:visible').length;
let os1n = $('.aitem[data-status*="Офер"][data-date2*="октябр"]:visible').length;
let ns1n = $('.aitem[data-status*="Офер"][data-date2*="ноябр"]:visible').length;
let ds1n = $('.aitem[data-status*="Офер"][data-date2*="декабр"]:visible').length;

// if(js1n > 0 && jan>0){js1 =jan/js1n;}
// if(fs1n > 0 && feb>0){fs1 =feb/fs1n;}
// if(mrs1n > 0 && mrt>0){mrs1 =mrt/mrs1n;}
// if(aps1n > 0 && apr>0){aps1 =apr/aps1n;}
// if(mas1n > 0 && may>0){mas1 =may/mas1n;}
// if(jns1n > 0 && jun>0){jns1 =jun/jns1n;}
// if(jls1n > 0 && jul>0){jls1 =jul/jls1n;}
// if(avs1n > 0 && avg>0){avs1 =avg/avs1n;}
// if(ss1n > 0 && sen>0){ss1 =sen/ss1n;}
// if(os1n > 0 && okt>0){os1 =okt/os1n;}
// if(ns1n > 0 && noy>0){ns1 =noy/ns1n;}
// if(ds1n > 0 && dek>0){ds1 =dek/ds1n;}
if(js1n > 0){js1 =js1n;}
if(fs1n > 0){fs1 =fs1n;}
if(mrs1n > 0){mrs1 =mrs1n;}
if(aps1n > 0){aps1 =aps1n;}
if(mas1n > 0){mas1 =mas1n;}
if(jns1n > 0){jns1 =jns1n;}
if(jls1n > 0){jls1 =jls1n;}
if(avs1n > 0){avs1 =avs1n;}
if(ss1n > 0){ss1 =ss1n;}
if(os1n > 0){os1 =os1n;}
if(ns1n > 0){ns1 =ns1n;}
if(ds1n > 0){ds1 =ds1n;}
const doffer = [js1,fs1,mrs1,aps1,mas1,jns1,jls1,avs1,ss1,os1,ns1,ds1];
// console.log(doffer);
// ----------------------------------------------------------------------------------------------------------
    const ctx = document.getElementById('myChart').getContext('2d');
    
   const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь' ],
            datasets: [
                {
                label: 'Количество отправленных кандидатов',
                data: d11,
                backgroundColor: [
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            },
            {
                label: 'Количество офферов',
                data: doffer,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }
        ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }); 
    $('#myChart').fadeIn('slow');
    let date5 = $('#date5').val();         
    let date6 = $('#date6').val();
    console.log('d5 '+date5);       
    console.log('d6 '+date6);       

// $(".ui-datepicker-trigger").removeAttr("title");
// -------------------------------------------------------------------------------------------------------------
let j2=f2=mr2=ap2=ma2=jn2=jl2=av2=s2=o2=n2=d2=0;
// let a1 = $('#ares .aitem[data-comp!=""]');
// console.log(a1);
let arr = $('#ares .aitem[data-comp!=""]:visible').map(function(){
    return $(this).attr('data-comp');
}).get();
// console.log(arrList);
//let arr = ["aa", "aa", "ab", "ab", "ac", "a", "s", "s", "s"];
let resultReduce = arr.reduce(function(acc, cur) {
  if (!acc.hash[cur]) {
    acc.hash[cur] = { [cur]:1 };
    acc.map.set(acc.hash[cur], 1);
    acc.result.push(acc.hash[cur]);
  } else {
    acc.hash[cur][cur] += 1;
    acc.map.set(acc.hash[cur], acc.hash[cur][cur]);
  }
  return acc;
}, {
  hash: {},
  map: new Map(),
  result: []
});

let result = resultReduce.result.sort(function(a, b) {
  return resultReduce.map.get(b) - resultReduce.map.get(a);
});

const compns = [];
const offrs = [];
// console.log(result);
for (let i = 0; i < result.length; i++) {
    let compn1 = Object.keys(result[i]);
    let ofer1 = Object.values(result[i]);

    compns.push(compn1);
    offrs.push(ofer1);
}
// console.log(compns);
// console.log(offrs);
// ...................................................................
let all_kand=ofer_kand= 0;
if($('#ares .aitem[data-status="Офер"]:visible').length>0){
    ofer_kand = $('#ares .aitem[data-status="Офер"]:visible').length;
}
if($('#ares .aitem:visible').length>0){
    all_kand = $('#ares .aitem:visible').length;
}
//let ofer_kand = $('#ares .aitem[data-comp!=""]:visible').length;
let kand_procent = ofer_kand*100/all_kand;
kand_procent = Math.round(kand_procent);

console.log(all_kand);
console.log(ofer_kand);
console.log(kand_procent+'%');

// if(!kand_procent){
//     kand_procent=0;
// }
let otpravil_ofer = [];
otpravil_ofer.push(100-kand_procent);
otpravil_ofer.push(kand_procent);

console.log(otpravil_ofer);
//let proc = 100-kand_procent;
// if(!kand_procent){
//     proc=0;
// }
if(kand_procent>0){
    $(".fc9").append('<div class="proc_descr">получили оффер</div>');
$(".fc9").append('<div class="procenty">'+kand_procent+'%</div>');
}
$(".fc8").append('<div class="hide_nmbrs"></div>');
$(".fc9").append('<div class="hide_nmbrs"></div>');
// ...................................................................
let v1d = $('.aitem[data-vupl1*="декабр"]:visible .vypl1');
let v2d = $('.aitem[data-vupl2*="декабр"]:visible .vypl2');
for (let i = 0; i < v1d.length; i++) {
    let v1 = v1d[i].textContent;
    if (v1!=='' && v1!==null) {d2=+v1+d2;}
}
for (let i = 0; i < v2d.length; i++) {
    let v2 = v2d[i].textContent;
    if (v2!=='' && v2!==null) {d2=+v2+d2;}
}
// ..................................................................
let vupl1 = $('.aitem[data-vupl1*="ноябр"]:visible .vypl1');
let vupl2 = $('.aitem[data-vupl2*="ноябр"]:visible .vypl2');
for (let i = 0; i < vupl1.length; i++) {
    let v1 = vupl1[i].textContent;
    if (v1!=='' && v1!==null) {n2=+v1+n2;}
}
for (let i = 0; i < vupl2.length; i++) {
    let v2 = vupl2[i].textContent;
    if (v2!=='' && v2!==null) {n2=+v2+n2;}
}
// ...................................................................
let v1ja = $('.aitem[data-vupl1*="январ"]:visible .vypl1');
let v2ja = $('.aitem[data-vupl2*="январ"]:visible .vypl2');
for (let i = 0; i < v1ja.length; i++) {
    let v1 = v1ja[i].textContent;
    if (v1!=='' && v1!==null) {j2=+v1+j2;}
}
for (let i = 0; i < v2ja.length; i++) {
    let v2 = v2ja[i].textContent;
    if (v2!=='' && v2!==null) {j2=+v2+j2;}
}
// ...................................................................
let v1f = $('.aitem[data-vupl1*="феврал"]:visible .vypl1');
let v2f = $('.aitem[data-vupl2*="феврал"]:visible .vypl2');
for (let i = 0; i < v1f.length; i++) {
    let v1 = v1f[i].textContent;
    if (v1!=='' && v1!==null) {f2=+v1+f2;}
}
for (let i = 0; i < v2f.length; i++) {
    let v2 = v2f[i].textContent;
    if (v2!=='' && v2!==null) {f2=+v2+f2;}
}
// ...................................................................
let v1ma = $('.aitem[data-vupl1*="март"]:visible .vypl1');
let v2ma = $('.aitem[data-vupl2*="март"]:visible .vypl2');
for (let i = 0; i < v1ma.length; i++) {
    let v1 = v1ma[i].textContent;
    if (v1!=='' && v1!==null) {mr2=+v1+mr2;}
}
for (let i = 0; i < v2ma.length; i++) {
    let v2 = v2ma[i].textContent;
    if (v2!=='' && v2!==null) {mr2=+v2+mr2;}
}
// ...................................................................
let v1apr = $('.aitem[data-vupl1*="апрел"]:visible .vypl1');
let v2apr = $('.aitem[data-vupl2*="апрел"]:visible .vypl2');
for (let i = 0; i < v1apr.length; i++) {
    let v1 = v1apr[i].textContent;
    if (v1!=='' && v1!==null) {ap2=+v1+ap2;}
}
for (let i = 0; i < v2apr.length; i++) {
    let v2 = v2apr[i].textContent;
    if (v2!=='' && v2!==null) {ap2=+v2+ap2;}
}
// ...................................................................
let v1may = $('.aitem[data-vupl1*="мая"]:visible .vypl1');
let v2may = $('.aitem[data-vupl2*="мая"]:visible .vypl2');
for (let i = 0; i < v1may.length; i++) {
    let v1 = v1may[i].textContent;
    if (v1!=='' && v1!==null) {ma2=+v1+ma2;}
}
for (let i = 0; i < v2may.length; i++) {
    let v2 = v2may[i].textContent;
    if (v2!=='' && v2!==null) {ma2=+v2+ma2;}
}
// ...................................................................
let v1jn = $('.aitem[data-vupl1*="июн"]:visible .vypl1');
let v2jn = $('.aitem[data-vupl2*="июн"]:visible .vypl2');
for (let i = 0; i < v1jn.length; i++) {
    let v1 = v1jn[i].textContent;
    if (v1!=='' && v1!==null) {jn2=+v1+jn2;}
}
for (let i = 0; i < v2jn.length; i++) {
    let v2 = v2jn[i].textContent;
    if (v2!=='' && v2!==null) {jn2=+v2+jn2;}
}
// ...................................................................
let v1jl = $('.aitem[data-vupl1*="июл"]:visible .vypl1');
let v2jl = $('.aitem[data-vupl2*="июл"]:visible .vypl2');
for (let i = 0; i < v1jl.length; i++) {
    let v1 = v1jl[i].textContent;
    if (v1!=='' && v1!==null) {jl2=+v1+jl2;}
}
for (let i = 0; i < v2jl.length; i++) {
    let v2 = v2jl[i].textContent;
    if (v2!=='' && v2!==null) {jl2=+v2+jl2;}
}
// ...................................................................
let v1av = $('.aitem[data-vupl1*="август"]:visible .vypl1');
let v2av = $('.aitem[data-vupl2*="август"]:visible .vypl2');
for (let i = 0; i < v1av.length; i++) {
    let v1 = v1av[i].textContent;
    if (v1!=='' && v1!==null) {av2=+v1+av2;}
}
for (let i = 0; i < v2av.length; i++) {
    let v2 = v2av[i].textContent;
    if (v2!=='' && v2!==null) {av2=+v2+av2;}
}
// ...................................................................
let v1s = $('.aitem[data-vupl1*="сентябр"]:visible .vypl1');
let v2s = $('.aitem[data-vupl2*="сентябр"]:visible .vypl2');
for (let i = 0; i < v1s.length; i++) {
    let v1 = v1s[i].textContent;
    if (v1!=='' && v1!==null) {s2=+v1+s2;}
}
for (let i = 0; i < v2s.length; i++) {
    let v2 = v2s[i].textContent;
    if (v2!=='' && v2!==null) {s2=+v2+s2;}
}
// ...................................................................
let v1o = $('.aitem[data-vupl1*="октябр"]:visible .vypl1');
let v2o = $('.aitem[data-vupl2*="октябр"]:visible .vypl2');
for (let i = 0; i < v1o.length; i++) {
    let v1 = v1o[i].textContent;
    if (v1!=='' && v1!==null) {o2=+v1+o2;}
}
for (let i = 0; i < v2o.length; i++) {
    let v2 = v2o[i].textContent;
    if (v2!=='' && v2!==null) {o2=+v2+o2;}
}

const d12 = [j2,f2,mr2,ap2,ma2,jn2,jl2,av2,s2,o2,n2,d2];
const ctx1 = document.getElementById('moneyChart').getContext('2d');
    
   const moneyChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь' ],
            datasets: [
                {
                label: 'было получено $',
                data: d12,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }
        ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }); 
    $('#moneyChart').fadeIn('slow');

   


      const ctx6 = document.getElementById('moneyChart6').getContext('2d');
    
   const moneyChart6 = new Chart(ctx6, {
        type: 'line',
        data: {
            labels: ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь' ],
            datasets: [
                {
                label: 'было получено $',
                data: d12,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1,
                lineTension: 0.5
            }
        ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }); 
    $('#moneyChart6').fadeIn('slow');

    // ----------------------------------------------------------------------
    const ctx7 = document.getElementById('myChart7').getContext('2d');
    
   const myChart7 = new Chart(ctx7, {
        type: 'line',
        data: {
            labels: ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь' ],
            datasets: [
                {
                label: 'Количество отправленных кандидатов',
                data: d11,
                backgroundColor: [
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1,
                lineTension: 0.5,
            },
            {
                label: 'Среднее количество кандидатов на оффер',
                data: doffer,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 2,
                lineTension: 0.4
            }
        ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }); 
    $('#myChart7').fadeIn('slow');

    let d13 = ['SQUAD', 'Sigma Software', 'Playtika', 'Daxx', 'Ciklum', 'NIX6'];
    let d14 = [12, 19, 3, 5, 2, 3];
    const ctx8 = document.getElementById('c8').getContext('2d');
const c8 = new Chart(ctx8, {
    type: 'pie',
    data: {
        labels: compns,
        datasets: [{
            label: 'количество нанятых кандидатов',
            data: offrs,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
// console.log(all_kand);
// console.log(ofer_kand);
// console.log(kand_procent+'%');
const ctx9 = document.getElementById('c9').getContext('2d');
const c9 = new Chart(ctx9, {
    type: 'doughnut',
    data: {
        labels: ["ещё в поиске (%)","получили оффер (%)"],
        datasets: [{
            label: 'количество нанятых кандидатов',
            data: otpravil_ofer,
            backgroundColor: [
                'rgba(54, 162, 235, 0.05)',
                'rgba(75, 192, 192, 0.4)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 0.4)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
  }          
});

  
// console.log(oktnum.length);
// console.log(sennum.length);
// --------------------------------------------------------------------------------------------------------------
   

    const ctx2 = document.getElementById('chart2').getContext('2d');
    const chart2 = new Chart(ctx2, {
        type: 'line',
        
        data: {
            labels: ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь' ],
            datasets: [
                {
                  label: 'Количество отправленных кандидатов',
                  data: [0, 10, 5, 0, 12, 11],
                  borderColor: 'rgba(153, 102, 255, 1)',
                  backgroundColor: 'rgba(153, 102, 255, 0.2)',
                },
                {
                    label: 'Среднее количество кандидатов на оффер',
                    data: [0, 5, 2.5, 0, 3, 4],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor:   'rgba(75, 192, 192, 0.2)',
                  }
              ]
            }       
    });

    // ====================================== PERIOD ===========================================
    // const d = new Date();

    // const month = d.getMonth()+1;
    // const day = d.getDate();

    // const output = d.getFullYear() + (month<10 ? '0' : '') + month + (day<10 ? '0' : '') + day;
    // console.log(output);
$('#period').on("change keyup", function () {
    const start1 = $('#date5').val();
    const end1 = $('#date6').val();
    //start1.toString().slice(2);
    const st1 = start1;
    console.log('s11 '+st1);
   // const add1 = $('#addd1').val();
  //  console.log(add1);
//   let s1 = $('#start5').html();
//         console.log(s1);
    if(start1 && end1) {
        
        if(start1) {
           // console.log('start1');
        }
        
        // console.log(end1);
    }
});

document.getElementById("event5").addEventListener("DOMSubtreeModified", function() {
    let st1 = parseInt($('#start5').text().split('-').join(''), 10);
    let end1 = parseInt($('#end5').text().split('-').join(''), 10);
      
    if(st1>0 && end1>0) {
        // st1 +=4;
        // end1 +=1;
        // console.log('s3'+st1);
        // console.log('e3'+end1);

        $(".aitem2").hide().filter(function () {
            let rtnData = "";
            let yearInp = $('#ayear').val();
            let monthInp = $('#amonth').val();
            
            rtnData = (                
                $(this).data("date3") <= end1 &&
                $(this).data("date3") >= st1
            );
    
        return rtnData;
        }).fadeIn('fast');

// .......................................................................................
    $("#ares20").remove();
    $(".fc80").remove();
    $(".fc90").remove();
    $("canvas#c80").remove();
    $("canvas#c90").remove();

        $("div.forChart10").append(' <div class="fc80"><canvas id="c80"></canvas></div>');
        $("div.forChart10").append(' <div class="fc90"><canvas id="c90"></canvas></div>');
// ......................................................................................
let arr5 = $('#ares2 .aitem2[data-comp!=""]:visible').map(function(){
    return $(this).attr('data-comp');
}).get();

let resultReduce5 = arr5.reduce(function(acc, cur) {
  if (!acc.hash[cur]) {
    acc.hash[cur] = { [cur]:1 };
    acc.map.set(acc.hash[cur], 1);
    acc.result.push(acc.hash[cur]);
  } else {
    acc.hash[cur][cur] += 1;
    acc.map.set(acc.hash[cur], acc.hash[cur][cur]);
  }
  return acc;
}, {
  hash: {},
  map: new Map(),
  result: []
});

let result5 = resultReduce5.result.sort(function(a, b) {
  return resultReduce5.map.get(b) - resultReduce5.map.get(a);
});

const compns5 = [];
const offrs5 = [];
// console.log(result5);

for (let i = 0; i < result5.length; i++) {
    let compn15 = Object.keys(result5[i]);
    let ofer15 = Object.values(result5[i]);

    compns5.push(compn15);
    offrs5.push(ofer15);
}
// console.log(compns5);
// console.log(offrs5);
// ...................................................................
let all_kand5=ofer_kand5= 0;
if($('#ares2 .aitem2[data-status="Офер"]:visible').length>0){
    ofer_kand5 = $('#ares2 .aitem2[data-status="Офер"]:visible').length;
}
if($('#ares2 .aitem2:visible').length>0){
    all_kand5 = $('#ares2 .aitem2:visible').length;
}

let kand_procent5 = ofer_kand5*100/all_kand5;
kand_procent5 = Math.round(kand_procent5);

console.log(all_kand5);
console.log(ofer_kand5);
console.log(kand_procent5+'%');

let otpravil_ofer5 = [];
otpravil_ofer5.push(100-kand_procent5);
otpravil_ofer5.push(kand_procent5);

console.log(otpravil_ofer5);

if(kand_procent5>0){
$(".fc90").append('<div class="proc_descr">получили оффер</div>');
$(".fc90").append('<div class="procenty">'+kand_procent5+'%</div>');
}
$(".fc80").append('<div class="hide_nmbrs"></div>');
$(".fc90").append('<div class="hide_nmbrs"></div>');
// ......................................................................................

        const ctx80 = document.getElementById('c80').getContext('2d');
        const c80 = new Chart(ctx80, {
            type: 'pie',
            data: {
                labels: compns5,
                datasets: [{
                    label: 'количество нанятых кандидатов',
                    data: offrs5,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
     // ......................................................................
   const ctx90 = document.getElementById('c90').getContext('2d');
const c90 = new Chart(ctx90, {
    type: 'doughnut',
    data: {
        labels: ["ещё в поиске (%)","получили оффер (%)"],
        datasets: [{
            label: 'количество нанятых кандидатов',
            data: otpravil_ofer5,
            backgroundColor: [
                'rgba(54, 162, 235, 0.05)',
                'rgba(75, 192, 192, 0.4)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 0.4)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

}
});
});