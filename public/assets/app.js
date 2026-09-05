(function(){
let charts={};
const el=id=>document.getElementById(id);
const money=v=>new Intl.NumberFormat('en-US',{style:'currency',currency:'USD',maximumFractionDigits:0}).format(v);
const number=v=>new Intl.NumberFormat('en-US').format(v);
async function load(days){
 const res=await fetch(window.dashboardEndpoint+'?days='+days,{headers:{'Accept':'application/json','X-Requested-With':'XMLHttpRequest'}});
 if(!res.ok) throw new Error('Unable to load dashboard data');
 return res.json();
}
function renderKpis(d){el('kpis').innerHTML=[['Revenue',money(d.kpis.revenue),'+12.8% vs previous'],['Users',number(d.kpis.users),'+9.6% vs previous'],['Orders',number(d.kpis.orders),'+7.4% vs previous'],['Conversion Rate',d.kpis.conversion+'%','+0.6% vs previous']].map(x=>`<div class="kpi-card"><div class="kpi-label">${x[0]}</div><div class="kpi-value">${x[1]}</div><div class="kpi-foot">${x[2]}</div></div>`).join('');}
function makeChart(id,type,data,options){if(charts[id]) charts[id].destroy(); charts[id]=new Chart(el(id),{type,data,options});}
function renderCharts(d){
 const common={responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{display:false},ticks:{color:'#98a2b3',font:{size:10}}},y:{grid:{color:'#eef0f5'},ticks:{color:'#98a2b3',font:{size:10}}}}};
 makeChart('performanceChart','line',{labels:d.labels,datasets:[{label:'Revenue',data:d.revenueSeries,borderColor:'#6d5efc',backgroundColor:'rgba(109,94,252,.08)',fill:true,tension:.35,yAxisID:'y'},{label:'Orders',data:d.orderSeries,borderColor:'#12b76a',backgroundColor:'transparent',tension:.35,yAxisID:'y1'}]},{...common,interaction:{mode:'index',intersect:false},scales:{x:common.scales.x,y:{position:'left',grid:{color:'#eef0f5'},ticks:{color:'#98a2b3'}},y1:{position:'right',grid:{drawOnChartArea:false},ticks:{color:'#98a2b3'}}}});
 makeChart('channelChart','doughnut',{labels:['Organic','Paid Ads','Social','Referral'],datasets:[{data:d.channels,backgroundColor:['#6d5efc','#12b76a','#f79009','#7c8da6'],borderWidth:0}]},{responsive:true,maintainAspectRatio:false,cutout:'70%',plugins:{legend:{display:false}}});
 makeChart('usersChart','bar',{labels:d.labels,datasets:[{data:d.newUsersSeries,backgroundColor:'#8b7fff',borderRadius:6}]},{...common,plugins:{legend:{display:false}},scales:{x:{grid:{display:false}},y:{grid:{color:'#eef0f5'}}}});
 el('channelPeriod').textContent=(d.period===365?'12 months':d.period+' days');
 el('channelList').innerHTML=[['Organic',d.channels[0]],['Paid Ads',d.channels[1]],['Social',d.channels[2]],['Referral',d.channels[3]]].map(x=>`<div class="channel-row"><span>${x[0]}</span><span>${x[1]}%</span></div>`).join('');
 el('funnel').innerHTML=d.funnel.map((x,i)=>{const pct=i===0?100:Math.round(x.value/d.funnel[0].value*100);return `<div class="funnel-row"><span>${x.label}</span><div class="funnel-bar"><div class="funnel-fill" style="width:${Math.max(5,pct)}%"></div></div><strong>${number(x.value)}</strong></div>`}).join('');
 el('newUsersStat').textContent=number(d.kpis.users);
}
let transactions=[];
function renderTables(d){transactions=d.transactions;renderTransactions(transactions);el('userBody').innerHTML=d.usersTable.map(u=>`<tr><td><strong>${u.name}</strong><br><span style="color:var(--muted)">${u.email}</span></td><td>${u.plan}</td><td>${money(u.spend)}</td><td>${u.orders}</td></tr>`).join('');}
function renderTransactions(rows){el('transactionBody').innerHTML=rows.length?rows.map(t=>`<tr><td><strong>${t.customer}</strong></td><td>${t.reference}</td><td>${t.date}</td><td>${money(t.amount)}</td><td><span class="status ${t.status}">${t.status}</span></td></tr>`).join(''):`<tr><td colspan="5" style="text-align:center;color:var(--muted)">No transactions found.</td></tr>`;}
async function refresh(){try{const d=await load(el('dateFilter').value);renderKpis(d);renderCharts(d);renderTables(d)}catch(e){console.error(e)}}
el('dateFilter').addEventListener('change',refresh);
el('transactionSearch').addEventListener('input',e=>{const q=e.target.value.toLowerCase();renderTransactions(transactions.filter(t=>Object.values(t).join(' ').toLowerCase().includes(q)))});
let sortAsc=true;document.querySelectorAll('th[data-sort]').forEach(th=>th.addEventListener('click',()=>{const key=th.dataset.sort;transactions.sort((a,b)=>{let av=a[key],bv=b[key];if(key==='amount') return sortAsc?av-bv:bv-av;return sortAsc?String(av).localeCompare(String(bv)):String(bv).localeCompare(String(av))});sortAsc=!sortAsc;renderTransactions(transactions)}));
el('themeBtn').addEventListener('click',()=>{document.body.classList.toggle('dark');localStorage.setItem('pulse-theme',document.body.classList.contains('dark')?'dark':'light')});if(localStorage.getItem('pulse-theme')==='dark')document.body.classList.add('dark');
el('menuBtn').addEventListener('click',()=>{el('sidebar').classList.toggle('open');el('overlay').classList.toggle('show')});el('overlay').addEventListener('click',()=>{el('sidebar').classList.remove('open');el('overlay').classList.remove('show')});
refresh();
})();
