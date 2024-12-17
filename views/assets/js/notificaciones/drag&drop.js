const dragAndDropItems = document.getElementById('contenedor-externo');

new Sortable(dragAndDropItems, {
  animation: 350,
  chosenClass: "contenedor-interno-chosen",
  dragClass: "contenedor-interno-drag",
});

// Notificaciones
const unreadNotifications = document.querySelectorAll(".unreaded");
const readAllButton = document.querySelector(".header p");
let allRead = false;

function toggleNotificationStatus(notification, isRead) {
  if (isRead) {
    notification.classList.add("readed");
    notification.classList.remove("unreaded");
    notification.querySelector(".unread-dot").style.display = "none";
  } else {
    notification.classList.remove("readed");
    notification.classList.add("unreaded");
    notification.querySelector(".unread-dot").style.display = "inline-block";
  }
}

unreadNotifications.forEach((notification) => {
  notification.addEventListener("click", () => {
    const isRead = notification.classList.contains("readed");
    toggleNotificationStatus(notification, !isRead);
  });
});

readAllButton.addEventListener("click", () => {
  allRead = !allRead;
  
  unreadNotifications.forEach((notification) => {
    toggleNotificationStatus(notification, allRead);
  });

  readAllButton.textContent = allRead ? "Mark all as unread" : "Mark all as read";
});