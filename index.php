<?php include 'check_session.php'; ?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Radio Music
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>
   /* Smooth scrolling */
   html {
     scroll-behavior: smooth;
   }
   
   /* Custom hover effect for albums */
   .hover-trigger:hover .hover-target {
     transform: translateY(-5px);
   }
   
   /* Custom shadow effect */
   .hover\:shadow-xl {
     box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2),
                 0 10px 10px -5px rgba(0, 0, 0, 0.1);
   }
   
   /* Smooth transitions */
   .transition {
     transition-property: all;
     transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
     transition-duration: 300ms;
   }
   
   /* Scale effect */
   .hover\:scale-105:hover {
     transform: scale(1.05);
   }
   
   /* Background color transition */
   .hover\:bg-gray-700:hover {
     background-color: rgba(55, 65, 81, 1);
   }

   /* Memastikan konten tidak terpotong oleh player musik */
   body {
     padding-bottom: 8rem; /* Memberikan ruang untuk music player */
   }

   /* Custom scrollbar */
   ::-webkit-scrollbar {
     width: 8px;
   }

   ::-webkit-scrollbar-track {
     background: #1a1a1a;
   }

   ::-webkit-scrollbar-thumb {
     background: #4a4a4a;
     border-radius: 4px;
   }

   ::-webkit-scrollbar-thumb:hover {
     background: #666;
   }

   /* Memastikan konten dapat di-scroll dengan lancar */
   .overflow-y-auto {
     -webkit-overflow-scrolling: touch;
   }

   /* Container untuk konten utama */
   .main-content {
     min-height: calc(100vh - 8rem); /* Tinggi viewport dikurangi tinggi player */
   }
  </style>
 </head>
 <body class="bg-gray-900 text-white font-roboto min-h-screen pb-10">
  <div class="flex flex-col md:flex-row min-h-screen">
   <!-- Sidebar -->
   <div class="bg-gray-800 w-full md:w-1/4 lg:w-1/5 p-4 sticky top-0 h-screen overflow-y-auto">
    <div class="text-2xl font-bold mb-6">
     Radio Music
    </div>
    
     <!-- User Profile Section -->
     <div class="mb-6 p-4 bg-gray-700 rounded-lg">
      <div class="flex items-center mb-4">
       <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-xl font-bold">
        <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
       </div>
       <div class="ml-3">
        <h3 class="font-bold text-white"><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
        <p class="text-sm text-gray-400"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
       </div>
      </div>
      <div class="h-px bg-gray-600 my-2"></div>
     </div>
     
     <nav>
      <ul>
       <li class="mb-4">
        <a class="flex items-center hover:text-green-400 transition duration-300" href="#">
         <i class="fas fa-home mr-3">
         </i>
         Home
        </a>
       </li>
       
       <!-- Saved Albums Section -->
       <li class="mb-4">
         <h3 class="text-gray-400 uppercase text-sm font-bold mb-2">Your Library</h3>
         <div class="space-y-2">
           <a class="flex items-center hover:text-green-400 transition duration-300" href="#" onclick="showSavedAlbums()">
             <i class="fas fa-music mr-3"></i>
             Radio Tersimpan
             <span id="savedCount" class="ml-2 text-sm text-gray-500">(0)</span>
           </a>
           
           <!-- Saved Albums List -->
           <div id="savedAlbumsList" class="ml-6 space-y-2 hidden">
             <!-- Saved albums will be inserted here dynamically -->
           </div>
         </div>
       </li>
       
       <li class="mt-auto">
        <hr class="my-4 border-gray-700">
        <a class="flex items-center text-red-500 hover:text-red-400 cursor-pointer transition duration-300" onclick="logout()">
         <i class="fas fa-sign-out-alt mr-3"></i>
         Logout
        </a>
       </li>
      </ul>
     </nav>
    </div>
   <!-- Main Content -->
   <div class="flex-1 p-4 overflow-y-auto pb-32">
    <!-- Album Section -->
    <div class="mb-8">
     <h2 class="text-3xl font-bold mb-4">
      Radio TerGacor
     </h2>
     <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <!-- Album 1 -->
      <div class="bg-gray-800 p-4 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="images/hard-rock.jpg" 
         class="w-full h-48 object-cover rounded-lg mb-4 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://n11.radiojar.com/7csmg90fuqruv?rj-ttl=5&rj-tok=AAABk9CE-wAA_REXi6ZYBNS8Vw"
         data-song-title="Hard Rock FM"
         data-artist-name="87.6 FM"
         alt="Album cover with abstract art in vibrant colors"
       />
       <h3 class="text-xl font-bold transition duration-300 hover:text-green-400">
        Hard Rock FM
       </h3>
       <p class="text-gray-400 transition duration-300 hover:text-white">
        87.6 FM
       </p>
       <button 
         onclick="saveAlbum('Hard Rock FM', '87.6 FM', 'images/hard-rock.jpg', 'https://n06.radiojar.com/7csmg90fuqruv?rj-ttl=5&rj-tok=AAABk8trgwsAcFyrhvdfuoyl4Q')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-4 py-2 rounded-full hover:border-white hover:text-white transition duration-300 flex items-center justify-center">
        <i class="fas fa-heart mr-2"></i> Simpan Radio
       </button>
      </div>
      <!-- Album 2 -->
      <div class="bg-gray-800 p-4 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="images/iradio.jpg"
         class="w-full h-48 object-cover rounded-lg mb-4 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://n01.radiojar.com/4ywdgup3bnzuv?rj-ttl=5&rj-tok=AAABk9CTrkMA3DiQnkKxftXnhQ"
         data-song-title="iRadio"
         data-artist-name="101.4 FM"
         alt="Album cover with abstract art in vibrant colors"
       />
       <h3 class="text-xl font-bold transition duration-300 hover:text-green-400">
        iRadio
       </h3>
       <p class="text-gray-400 transition duration-300 hover:text-white">
        101.4 FM
       </p>
       <button 
         onclick="saveAlbum('iRadio', '101.4 FM', 'images/iradio.jpg', 'https://s1.cloudmu.id/listen/delta_fm/radio.mp3')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-4 py-2 rounded-full hover:border-white hover:text-white transition duration-300 flex items-center justify-center">
        <i class="fas fa-heart mr-2"></i> Simpan Radio
       </button>
      </div>
      <!-- Album 3 -->
      <div class="bg-gray-800 p-4 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="images/prambors.jpg"
         class="w-full h-48 object-cover rounded-lg mb-4 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://22243.live.streamtheworld.com/PRAMBORS_FM.mp3?dist=pramborsweb&tdsdk=js-2.9&swm=false&pname=tdwidgets&pversion=2.9&banners=300x250&burst-time=15&sbmid=07a202ec-d55c-4aa7-a13f-311fc20275a0"
         data-song-title="Prambors"
         data-artist-name="102.2 FM"
         alt="Album cover with a close-up of a musical instrument"
       />
       <h3 class="text-xl font-bold transition duration-300 hover:text-green-400">
        Prambors
       </h3>
       <p class="text-gray-400 transition duration-300 hover:text-white">
        102.2 FM
       </p>
       <button 
         onclick="saveAlbum('Prambors', '102.2 FM', 'images/prambors.jpg', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-4 py-2 rounded-full hover:border-white hover:text-white transition duration-300 flex items-center justify-center">
        <i class="fas fa-heart mr-2"></i> Simpan Radio
       </button>
      </div>
      <!-- Album 4 -->
      <div class="bg-gray-800 p-4 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="images/trax.jpg"
         class="w-full h-48 object-cover rounded-lg mb-4 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://n0f.radiojar.com/rrqf78p3bnzuv?rj-ttl=5&rj-tok=AAABk9CsSgUAn0_XeJAR84WRCA"
         data-song-title="TRAX"
         data-artist-name="108.0 FM"
         alt="Album cover with a futuristic cityscape"
       />
       <h3 class="text-xl font-bold transition duration-300 hover:text-green-400">
        TRAX
       </h3>
       <p class="text-gray-400 transition duration-300 hover:text-white">
        108.0 FM
       </p>
       <button 
         onclick="saveAlbum('TRAX', '108.0 FM', 'images/trax.jpg', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-4 py-2 rounded-full hover:border-white hover:text-white transition duration-300 flex items-center justify-center">
        <i class="fas fa-heart mr-2"></i> Simpan Radio
       </button>
      </div>
     </div>
    </div>
    <!-- Small Album View Section -->
    <div class="mb-8">
     <h2 class="text-3xl font-bold mb-4">
      Radio Campuran
     </h2>
     <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
      <!-- Small Album 1 -->
      <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="images/gajahmada.png"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://server.radioimeldafm.co.id/radio/8040/gajahmadafm"
         data-song-title="Gajah Mada"
         data-artist-name="102.4 FM"
         alt="Small album cover with abstract art"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        Gajah Mada
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        102.4 FM
       </p>
       <button 
         onclick="saveAlbum('Gajah Mada', '102.4 FM', 'images/gajahmada.png', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
       <!-- Small Album 1 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="images/idola.jpg"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://server.radioidola.com:8880/idolafm"
         data-song-title="Idola"
         data-artist-name="92.6 FM"
         alt="Small album cover with abstract art"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        Idola
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        92.6 FM
       </p>
       <button 
         onclick="saveAlbum('Idola', '92.6 FM', 'images/idola.jpg', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
       <!-- Small Album 1 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="https://cdn-profiles.tunein.com/s140318/images/logod.png?t=638112290320000000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://server.radioimeldafm.co.id:8030/imeldafm"
         data-song-title="ImeldaFM"
         data-artist-name="104.4 FM"
         alt="Small album cover with abstract art"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        ImeldaFM
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        104.4 FM
       </p>
       <button 
         onclick="saveAlbum('ImeldaFM', '104.4 FM', 'https://cdn-profiles.tunein.com/s140318/images/logod.png?t=638112290320000000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
       <!-- Small Album 1 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="https://cdn-radiotime-logos.tunein.com/s188219d.png"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="http://202.147.199.100:8000/;stream.nsv"
         data-song-title="V Radio"
         data-artist-name="106.6 FM"
         alt="Small album cover with abstract art"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        V Radio
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        106.6 FM
       </p>
       <button 
         onclick="saveAlbum('V Radio', '106.6 FM', 'https://cdn-radiotime-logos.tunein.com/s188219d.png', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
       <!-- Small Album 1 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="https://cdn-profiles.tunein.com/s22162/images/logod.png?t=637685566470000000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://18073.live.streamtheworld.com/WQHTFMAAC.aac?DIST=TuneIn&TGT=TuneIn&maxServers=2&gdpr=0&partnertok=eyJhbGciOiJIUzI1NiIsImtpZCI6InR1bmVpbiIsInR5cCI6IkpXVCJ9.eyJ0cnVzdGVkX3BhcnRuZXIiOnRydWUsImlhdCI6MTczNDM3NDI1NSwiaXNzIjoidGlzcnYifQ.tW3G7Czb-G2Qb_J2HsOy3_Qsp5g3x8tvMZx7e6tDUi4"
         data-song-title="WHP Radio"
         data-artist-name="HOT 97.3 FM"
         alt="Small album cover with abstract art"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        WHP Radio
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        97.3 FM
       </p>
       <button 
         onclick="saveAlbum('WHP Radio', '97.3 FM', 'https://cdn-profiles.tunein.com/s22162/images/logod.png?t=637685566470000000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
       <!-- Small Album 1 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="https://cdn-profiles.tunein.com/s180099/images/logod.jpg?t=638149764570000000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://28153.live.streamtheworld.com/KISS_92AAC.aac?DIST=TuneIn&TGT=TuneIn&maxServers=2&gdpr=0&partnertok=eyJhbGciOiJIUzI1NiIsImtpZCI6InR1bmVpbiIsInR5cCI6IkpXVCJ9.eyJ0cnVzdGVkX3BhcnRuZXIiOnRydWUsImlhdCI6MTczNDM3NDU1MCwiaXNzIjoidGlzcnYifQ.oRk_RaBTLQZL44a4cbL5inziaYN8UxJ8ZGpSBEICSsc"
         data-song-title="Kiss Radio"
         data-artist-name="92.3 FM"
         alt="Small album cover with abstract art"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        Kiss Radio
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        92.3 FM
       </p>
       <button 
         onclick="saveAlbum('Kiss Radio', '92.3 FM', 'https://cdn-profiles.tunein.com/s180099/images/logod.jpg?t=638149764570000000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
       <!-- Small Album 1 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="https://cdn-profiles.tunein.com/s53927/images/logod.jpg?t=638614944260000000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://22903.live.streamtheworld.com/987FM_PREM.aac?DIST=TuneIn&TGT=TuneIn&maxServers=2&gdpr=0&partnertok=eyJhbGciOiJIUzI1NiIsImtpZCI6InR1bmVpbiIsInR5cCI6IkpXVCJ9.eyJ0cnVzdGVkX3BhcnRuZXIiOnRydWUsImlhdCI6MTczNDM3NDgwOSwiaXNzIjoidGlzcnYifQ.JFPJirlJNYu8aBp_duuyvv5qNhC6nsQ1a2XbsdBf5Jk"
         data-song-title="MediaCorp FM"
         data-artist-name="98.7 FM"
         alt="Small album cover with abstract art"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        MediaCorp FM
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        98.7 FM
       </p>
       <button 
         onclick="saveAlbum('MediaCorp FM', '98.7 FM', 'https://cdn-profiles.tunein.com/s53927/images/logod.jpg?t=638614944260000000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
       <!-- Small Album 1 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="https://cdn-profiles.tunein.com/s1217/images/logod.png?t=637969312540000000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://rs101-krk-cyfronet.rmfstream.pl/rmf_fm?aw_0_1st.playerid=RMF_TuneIn&skey=1734375013&aw_0_req.gdpr=0&aw_0_req.userConsentV2="
         data-song-title="RMF FM"
         data-artist-name="96.0 FM"
         alt="Small album cover with abstract art"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        RMF FM
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        96.0 FM
       </p>
       <button 
         onclick="saveAlbum('RMF FM', '96.0 FM', 'https://cdn-profiles.tunein.com/s1217/images/logod.png?t=637969312540000000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
       <!-- Small Album 1 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="https://cdn-profiles.tunein.com/s142793/images/logod.jpg?t=636637144007970000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://stream.denger.in:8888/dmi"
         data-song-title="DMI FM"
         data-artist-name="107.0 FM"
         alt="Small album cover with abstract art"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        DMI FM
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        107.0 FM
       </p>
       <button 
         onclick="saveAlbum('DMI FM', '107.0 FM', 'https://cdn-profiles.tunein.com/s142793/images/logod.jpg?t=636637144007970000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
       <!-- Small Album 1 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="https://cdn-profiles.tunein.com/s199777/images/logod.jpg?t=636643084781630000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://streaming06.liveboxstream.uk/proxy/dbmradio/stream"
         data-song-title="DBM Radio"
         data-artist-name="108.0 FM"
         alt="Small album cover with abstract art"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        DBM Radio
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        108.0 FM
       </p>
       <button 
         onclick="saveAlbum('DBM Radio', '108.0 FM', 'https://cdn-profiles.tunein.com/s199777/images/logod.jpg?t=636643084781630000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
      <!-- Small Album 5 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="https://cdn-profiles.tunein.com/s7678/images/logod.png?t=637456337200000000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://azul-2.nty.uy/stream"
         data-song-title="Azul FM"
         data-artist-name="101.9 FM"
         alt="Small album cover with pattern"
       />
       <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">
        Azul FM
       </h3>
       <p class="text-xs text-gray-400 mb-2 transition duration-300 hover:text-white">
        101.9 FM
       </p>
       <button 
         onclick="saveAlbum('Azul FM', '101.9 FM', 'https://cdn-profiles.tunein.com/s7678/images/logod.png?t=637456337200000000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>
      </div>
      </div>
    <!-- Large Album Section -->
    <div class="mb-8">
      <h2 class="text-3xl font-bold mb-4">Radio JedagJedug</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Large Album 1 -->
        <div class="bg-gray-800 p-6 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
          <img 
            src="https://cdn-profiles.tunein.com/s298278/images/logod.png?t=637191113270000000"
            class="w-full h-64 object-cover rounded-lg mb-4 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
            data-song-url="https://stream.coolkas.com/radio/8160/radiocmn"
            data-song-title="Radio CMN"
            data-artist-name="81.6 FM"
            alt="Featured album cover"
          />
          <div class="space-y-2">
            <h3 class="text-2xl font-bold transition duration-300 hover:text-green-400">Radio CMN</h3>
            <p class="text-gray-400 text-lg transition duration-300 hover:text-white">81.6 FM</p>
            
            <div class="flex space-x-4 mt-4">
       <button 
         onclick="playSong(this)"
                data-song-url="https://n06.radiojar.com/7csmg90fuqruv?rj-ttl=5&rj-tok=AAABk8trgwsAcFyrhvdfuoyl4Q"
                data-song-title="Radio CMN"
                data-artist-name="81.6 FM"
                class="flex-1 bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition duration-300">
                <i class="fas fa-play mr-2"></i> Putar Radio
       </button>
       <button 
                onclick="saveAlbum('Radio CMN', '81.6 FM', 'https://cdn-profiles.tunein.com/s298278/images/logod.png?t=637191113270000000', '#')" 
                class="flex-1 border border-gray-400 text-gray-400 px-6 py-2 rounded-full hover:border-white hover:text-white transition duration-300 flex items-center justify-center">
                <i class="fas fa-heart mr-2"></i> Simpan Radio
       </button>
      </div>
      </div>
      </div>

        <!-- Large Album 2 -->
        <div class="bg-gray-800 p-6 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
            src="https://cdn-profiles.tunein.com/s278797/images/logod.png?t=636939567800000000"
            class="w-full h-64 object-cover rounded-lg mb-4 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
            data-song-url="https://sukmben.radiogentara.com:8081/gentarahd"
            data-song-title="Radio Gentara"
            data-artist-name="103.0 FM"
            alt="Featured album cover"
          />
          <div class="space-y-2">
            <h3 class="text-2xl font-bold transition duration-300 hover:text-green-400">Radio Gentara</h3>
            <p class="text-gray-400 text-lg transition duration-300 hover:text-white">103.0 FM</p>
            <div class="flex space-x-4 mt-4">
       <button 
         onclick="playSong(this)"
                data-song-url="https://s1.cloudmu.id/listen/delta_fm/radio.mp3"
                data-song-title="Radio Gentara"
                data-artist-name="103.0 FM"
                class="flex-1 bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition duration-300">
                <i class="fas fa-play mr-2"></i> Putar Radio
       </button>
       <button 
                onclick="saveAlbum('Radio Gentara', '103.0 FM', 'https://cdn-profiles.tunein.com/s278797/images/logod.png?t=636939567800000000', '#')" 
                class="flex-1 border border-gray-400 text-gray-400 px-6 py-2 rounded-full hover:border-white hover:text-white transition duration-300 flex items-center justify-center">
                <i class="fas fa-heart mr-2"></i> Simpan Radio
       </button>
      </div>
      </div>
      </div>

        <!-- Large Album 3 -->
        <div class="bg-gray-800 p-6 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
            src="https://cdn-profiles.tunein.com/s253879/images/logod.jpg?t=637598851070000000"
            class="w-full h-64 object-cover rounded-lg mb-4 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://22353.live.streamtheworld.com/WEB10_MP3_SC?dist=TUNEIN"
            data-song-title="SLAM!"
            data-artist-name="100.0 FM"
            alt="Featured album cover"
          />
          <div class="space-y-2">
            <h3 class="text-2xl font-bold transition duration-300 hover:text-green-400">SLAM!</h3>
            <p class="text-gray-400 text-lg transition duration-300 hover:text-white">100.0 FM</p>
            <div class="flex space-x-4 mt-4">
       <button 
         onclick="playSong(this)"
         data-song-url="#"
                data-song-title="SLAM!"
                data-artist-name="100.0 FM"
                class="flex-1 bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition duration-300">
                <i class="fas fa-play mr-2"></i> Putar Radio
       </button>
       <button 
                onclick="saveAlbum('SLAM!', '100.0 FM', 'https://cdn-profiles.tunein.com/s253879/images/logod.jpg?t=637598851070000000', '#')" 
                class="flex-1 border border-gray-400 text-gray-400 px-6 py-2 rounded-full hover:border-white hover:text-white transition duration-300 flex items-center justify-center">
                <i class="fas fa-heart mr-2"></i> Simpan Radio
       </button>
      </div>
      </div>
      </div>

      </div>
      </div>
    <!-- New Releases Section -->
    <div class="mb-8">
      <h2 class="text-3xl font-bold mb-4">Radio Koplo & Pop</h2>
      <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        
        <!-- New Release 1 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
            src="https://cdn-radiotime-logos.tunein.com/s24935d.png"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://n03.rcs.revma.com/ugpyzu9n5k3vv?rj-ttl=5&rj-tok=AAABk9PJAIEA0fc835F7pDz3Pg"
            data-song-title="ARDAN FM"
            data-artist-name="105.9 FM"
            alt="New release album cover"
          />
          <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">ARDAN FM</h3>
          <p class="text-xs text-gray-400 mb-2">105.9 FM</p>
       <button 
            onclick="saveAlbum('ARDAN FM', '105.9 FM', 'https://cdn-radiotime-logos.tunein.com/s24935d.png', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>

        <!-- New Release 2 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
            src="https://cdn-profiles.tunein.com/s31121/images/logod.jpg?t=636609417620370000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://blackburn-ais.leanstream.co/CFGXFM-MP3?args=tuneIn_01&DIST=TuneIn&TGT=TuneIn&maxServers=2&gdpr=0&partnertok=eyJhbGciOiJIUzI1NiIsImtpZCI6InR1bmVpbiIsInR5cCI6IkpXVCJ9.eyJ0cnVzdGVkX3BhcnRuZXIiOnRydWUsImlhdCI6MTczNDQyNDg3OSwiaXNzIjoidGlzcnYifQ.3vMb_ogyed8q3KNQ2mwatboP8ZRNztQfl0fSsEKkDrw"
            data-song-title="The Fox FM"
            data-artist-name="99.9 FM"
            alt="New release album cover"
          />
          <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">The Fox FM</h3>
          <p class="text-xs text-gray-400 mb-2">99.9 FM</p>
       <button 
            onclick="saveAlbum('The Fox FM', '99.9 FM', 'https://cdn-profiles.tunein.com/s31121/images/logod.jpg?t=636609417620370000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>

        <!-- New Release 3 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
            src="https://cdn-profiles.tunein.com/s95790/images/logod.jpg?t=637098553550000000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://s2.radio.co/sae3372059/low"
            data-song-title="One FM"
            data-artist-name="98.5 FM"
            alt="New release album cover"
          />
          <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">One FM</h3>
          <p class="text-xs text-gray-400 mb-2">98.5 FM</p>
       <button 
            onclick="saveAlbum('One FM', '98.5 FM', 'https://cdn-profiles.tunein.com/s95790/images/logod.jpg?t=637098553550000000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>

        <!-- New Release 4 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
            src="https://cdn-profiles.tunein.com/s186154/images/logod.jpg?t=637800170300000000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://stream-173.zeno.fm/954yxsx00ehvv?zt=eyJhbGciOiJIUzI1NiJ9.eyJzdHJlYW0iOiI5NTR5eHN4MDBlaHZ2IiwiaG9zdCI6InN0cmVhbS0xNzMuemVuby5mbSIsInJ0dGwiOjUsImp0aSI6Ik1sZ04tdkhSU295VDd4YWFwRDNWUlEiLCJpYXQiOjE3MzQ0MjUzNDUsImV4cCI6MTczNDQyNTQwNX0.BihNBjQDhd5yux2iI4xPrjRz-utuHLaRoI1d5SOtPDg"
            data-song-title="Radio Online Tulungagung"
            data-artist-name="96.0 FM"
            alt="New release album cover"
          />
          <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">Radio Online Tulungagung</h3>
          <p class="text-xs text-gray-400 mb-2">96.0 FM</p>
       <button 
            onclick="saveAlbum('Radio Online Tulungagung', '96.0 FM', 'https://cdn-profiles.tunein.com/s186154/images/logod.jpg?t=637800170300000000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>

        <!-- New Release 5 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
            src="https://cdn-profiles.tunein.com/s172498/images/logod.jpg?t=637063890940000000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://streaming.suzanafm.com:8100/;"
            data-song-title="EBS FM"
            data-artist-name="105.9 FM"
            alt="New release album cover"
          />
          <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">EBS FM</h3>
          <p class="text-xs text-gray-400 mb-2">105.9 FM</p>
       <button 
            onclick="saveAlbum('EBS FM', '105.9 FM', 'https://cdn-profiles.tunein.com/s172498/images/logod.jpg?t=637063890940000000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>

        <!-- New Release 6 -->
       <div class="bg-gray-800 p-2 rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gray-700">
       <img 
         src="https://cdn-profiles.tunein.com/s299056/images/logod.png?t=637875979000000000"
         class="w-full h-24 object-cover rounded-lg mb-2 cursor-pointer transform transition duration-300 hover:opacity-80"
         onclick="playSong(this)"
         data-song-url="https://stream.lokermusik.com/radio/8420/lokermusik"
            data-song-title="Lokermusik"
            data-artist-name="95.0 FM"
            alt="New release album cover"
          />
          <h3 class="text-sm font-bold transition duration-300 hover:text-green-400">Lokermusik</h3>
          <p class="text-xs text-gray-400 mb-2">95.0 FM</p>
       <button 
            onclick="saveAlbum('Lokermusik', '95.0 FM', 'https://cdn-profiles.tunein.com/s299056/images/logod.png?t=637875979000000000', '#')" 
         class="w-full bg-transparent border border-gray-400 text-gray-400 px-2 py-1 rounded-full hover:border-white hover:text-white transition duration-300 text-xs flex items-center justify-center">
        <i class="fas fa-heart mr-1"></i> Simpan Radio
       </button>
      </div>

      </div>
      </div>
      </div>
      </div>
  
  
  <!-- Media Player -->
  <div class="fixed bottom-0 left-0 right-0 bg-gray-800 p-4 flex items-center justify-between">
   <div class="flex items-center">
    <img alt="Album cover" class="w-12 h-12 object-cover rounded-lg mr-4" id="currentAlbumCover" src=""/>
    <div>
     <h3 class="text-lg font-bold" id="currentSongTitle">Select a song</h3>
     <p class="text-sm text-gray-400" id="currentArtist">-</p>
      </div>
      </div>
   
   <div class="flex flex-col items-center flex-grow mx-4">
    <div class="flex items-center mb-2">
     <button class="text-gray-400 hover:text-white mx-2" onclick="previousSong()">
      <i class="fas fa-step-backward"></i>
       </button>
     <button class="text-gray-400 hover:text-white mx-2" onclick="togglePlay()">
      <i class="fas fa-play" id="playPauseIcon"></i>
     </button>
     <button class="text-gray-400 hover:text-white mx-2" onclick="nextSong()">
      <i class="fas fa-step-forward"></i>
       </button>
      </div>
    
    <div class="flex items-center w-full">
     <span id="currentTime" class="text-xs text-gray-400 mr-2">0:00</span>
     <input 
       type="range" 
       id="seekBar" 
       class="w-full h-1 bg-gray-600 rounded-lg"
       step="1"
       value="0"
     />
     <span id="duration" class="text-xs text-gray-400 ml-2">0:00</span>
      </div>
   </div>

   <div class="flex items-center">
    <i class="fas fa-volume-up text-gray-400 mr-2"></i>
    <input 
      type="range" 
      id="volumeControl" 
      class="w-24 h-1 bg-gray-600 rounded-lg"
      min="0"
      max="1"
      step="0.1"
      value="1"
    />
      </div>
  </div>

  <audio id="audioPlayer"></audio>

  <script>
  let currentSongIndex = -1;
  const playlist = []; // Will be populated when songs are clicked

  function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    seconds = Math.floor(seconds % 60);
    return `${minutes}:${seconds.toString().padStart(2, '0')}`;
  }

  function playSong(element) {
    const audio = document.getElementById('audioPlayer');
    const songUrl = element.getAttribute('data-song-url');
    const songTitle = element.getAttribute('data-song-title');
    const artistName = element.getAttribute('data-artist-name');
    
    // Add song to playlist if not exists
    const songData = {
      url: songUrl,
      title: songTitle,
      artist: artistName,
      cover: element.src
    };
    
    const songIndex = playlist.findIndex(song => song.url === songUrl);
    if (songIndex === -1) {
      playlist.push(songData);
      currentSongIndex = playlist.length - 1;
    } else {
      currentSongIndex = songIndex;
    }
    
    loadAndPlaySong(songData);
  }

  function loadAndPlaySong(songData) {
    const audio = document.getElementById('audioPlayer');
    const playPauseIcon = document.getElementById('playPauseIcon');
    
    // Update audio source
    audio.src = songData.url;
    
    // Update player info
    document.getElementById('currentSongTitle').textContent = songData.title;
    document.getElementById('currentArtist').textContent = songData.artist;
    document.getElementById('currentAlbumCover').src = songData.cover;
    
    // Play the song
    audio.play();
    
    // Update play button icon
    playPauseIcon.classList.remove('fa-play');
    playPauseIcon.classList.add('fa-pause');
  }

  function togglePlay() {
    const audio = document.getElementById('audioPlayer');
    const playPauseIcon = document.getElementById('playPauseIcon');
    
    if (audio.paused) {
      audio.play();
      playPauseIcon.classList.remove('fa-play');
      playPauseIcon.classList.add('fa-pause');
    } else {
      audio.pause();
      playPauseIcon.classList.remove('fa-pause');
      playPauseIcon.classList.add('fa-play');
    }
  }

  function previousSong() {
    if (currentSongIndex > 0) {
      currentSongIndex--;
      loadAndPlaySong(playlist[currentSongIndex]);
    }
  }

  function nextSong() {
    if (currentSongIndex < playlist.length - 1) {
      currentSongIndex++;
      loadAndPlaySong(playlist[currentSongIndex]);
    }
  }

  // Set up audio event listeners
  document.addEventListener('DOMContentLoaded', function() {
    const audio = document.getElementById('audioPlayer');
    const seekBar = document.getElementById('seekBar');
    const volumeControl = document.getElementById('volumeControl');
    const currentTimeDisplay = document.getElementById('currentTime');
    const durationDisplay = document.getElementById('duration');

    function nextSong() {
    if (playlist.length === 0) return; // Jika playlist kosong
    
    if (currentSongIndex < playlist.length - 1) {
        currentSongIndex++;
    } else {
        // Kembali ke awal playlist jika sudah di akhir
        currentSongIndex = 0;
    }
    
    loadAndPlaySong(playlist[currentSongIndex]);
}

// Tambahkan event listener untuk auto-next saat lagu selesai
document.addEventListener('DOMContentLoaded', function() {
    const audio = document.getElementById('audioPlayer');
    
    audio.addEventListener('ended', function() {
        nextSong();
    });
});

// Perbaikan fungsi previousSong
function previousSong() {
    if (playlist.length === 0) return; // Jika playlist kosong
    
    if (currentSongIndex > 0) {
        currentSongIndex--;
    } else {
        // Pindah ke akhir playlist jika sudah di awal
        currentSongIndex = playlist.length - 1;
    }
    
    loadAndPlaySong(playlist[currentSongIndex]);
}

    // Update seek bar as audio plays
    audio.addEventListener('timeupdate', function() {
      const percentage = (audio.currentTime / audio.duration) * 100;
      seekBar.value = percentage;
      currentTimeDisplay.textContent = formatTime(audio.currentTime);
    });

    // Update audio position when seek bar is changed
    seekBar.addEventListener('change', function() {
      const time = (seekBar.value / 100) * audio.duration;
      audio.currentTime = time;
    });

    // Set up volume control
    volumeControl.addEventListener('input', function() {
      audio.volume = volumeControl.value;
    });

    // Update duration display when metadata is loaded
    audio.addEventListener('loadedmetadata', function() {
      seekBar.max = 100;
      durationDisplay.textContent = formatTime(audio.duration);
    });

    // Auto play next song when current song ends
    audio.addEventListener('ended', function() {
      nextSong();
    });
  });

  function logout() {
    // Konfirmasi logout
    if(confirm('Are you sure you want to logout?')) {
      // Redirect ke halaman logout.php
      window.location.href = 'logout.php';
    }
  }

  // Array to store saved albums
  let savedAlbums = [];

  // Function to save album
  function saveAlbum(title, artist, cover, songUrl) {
    const album = {
      title: title,
      artist: artist,
      cover: cover,
      songUrl: songUrl
    };
    
    // Check if album already exists
    if (!savedAlbums.some(a => a.title === title)) {
      savedAlbums.push(album);
      updateSavedAlbumsList();
      
      // Show notification
      showNotification('Album saved successfully!');
    } else {
      showNotification('Album already saved!');
    }
  }

  // Function to remove saved album
  function removeSavedAlbum(title) {
    savedAlbums = savedAlbums.filter(album => album.title !== title);
    updateSavedAlbumsList();
    showNotification('Album removed from library');
  }

  // Function to update saved albums list
  function updateSavedAlbumsList() {
    const container = document.getElementById('savedAlbumsList');
    const countElement = document.getElementById('savedCount');
    
    // Update count
    countElement.textContent = `(${savedAlbums.length})`;
    
    // Clear current list
    container.innerHTML = '';
    
    // Add each saved album
    savedAlbums.forEach(album => {
      const albumElement = document.createElement('div');
      albumElement.className = 'flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-700 group';
      albumElement.innerHTML = `
        <div class="flex items-center">
          <img src="${album.cover}" class="w-8 h-8 rounded mr-2" alt="${album.title}"/>
          <div>
            <div class="text-sm font-medium">${album.title}</div>
            <div class="text-xs text-gray-400">${album.artist}</div>
          </div>
        </div>
        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition duration-300">
          <button onclick="playSavedAlbum('${album.songUrl}', '${album.title}', '${album.artist}', '${album.cover}')" 
                  class="text-green-400 hover:text-green-300">
            <i class="fas fa-play"></i>
          </button>
          <button onclick="removeSavedAlbum('${album.title}')" 
                  class="text-red-400 hover:text-red-300">
            <i class="fas fa-times"></i>
       </button>
      </div>
      `;
      container.appendChild(albumElement);
    });
    
    // Save to localStorage
    localStorage.setItem('savedAlbums', JSON.stringify(savedAlbums));
  }

  // Function to show/hide saved albums list
  function showSavedAlbums() {
    const list = document.getElementById('savedAlbumsList');
    list.classList.toggle('hidden');
  }

  // Function to play saved album
  function playSavedAlbum(songUrl, title, artist, cover) {
    const songData = {
      url: songUrl,
      title: title,
      artist: artist,
      cover: cover
    };
    loadAndPlaySong(songData);
  }

  // Function to show notification
  function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed bottom-20 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg transform transition-all duration-300';
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Remove notification after 3 seconds
    setTimeout(() => {
      notification.style.opacity = '0';
      setTimeout(() => notification.remove(), 300);
    }, 3000);
  }

  // Load saved albums from localStorage on page load
  document.addEventListener('DOMContentLoaded', function() {
    const saved = localStorage.getItem('savedAlbums');
    if (saved) {
      savedAlbums = JSON.parse(saved);
      updateSavedAlbumsList();
    }
  });
  
  </script>
 </body>
</html>
