function openNav() {
  document.getElementById("friendsBar").style.width = "200px";
  document.getElementById("main").style.marginLeft = "-100px";
}

function closeNav() {
  document.getElementById("friendsBar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}

let statusTimeout = 0;

function setStatus(status) {
  console.log('status => ' + status);

  var statusCircle = document.querySelector('.status-circle');
  var statusText = document.querySelector('.status-text');

  switch (status) {
      case 'online':
          statusCircle.style.backgroundColor = '#2ECC71';
          statusText.innerText = 'Online';
          statusText.style.color = '#2ECC71';
          break;
      case 'away':
          statusCircle.style.backgroundColor = '#F1C40F';
          statusText.innerText = 'Away';
          statusText.style.color = '#F1C40F';
          break;
      case 'offline':
          statusCircle.style.backgroundColor = '#E74C3C';
          statusText.innerText = 'Offline';
          statusText.style.color = '#E74C3C';
          break;
  }
}

function resetStatusTimeout() {
  console.log('time => ' + statusTimeout);
  clearTimeout(statusTimeout);
  setStatus('online');
  statusTimeout = setTimeout(() => setStatus('away'), 10000);
}

document.addEventListener('mousemove', resetStatusTimeout);

setStatus('offline');
resetStatusTimeout();

const hoverArea = document.querySelector('.hover-area');
hoverArea.addEventListener('mouseenter', openNav);
hoverArea.addEventListener('mouseleave', closeNav);

document.addEventListener('DOMContentLoaded', () => {
    const preloaderVideo = document.getElementById('preloaderVideo');
    const backgroundAudio = document.getElementById('backgroundAudio');
    const preloader = document.getElementById('preloader');

    preloaderVideo.addEventListener('ended', () => {
        preloader.style.display = 'none';
        backgroundAudio.play();
    });
});
