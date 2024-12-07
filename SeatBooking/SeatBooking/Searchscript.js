let products = {
  data: [
    {
      productName: "Galle - Colombo-Rs.1950",
      category: "Colombo",
      image: "https://www.pngall.com/wp-content/uploads/2016/05/Bus-PNG-Picture.png",
      url: "http://localhost/SeatBooking/bus1"
    },
    {
      productName: "Galle - Mathara-Rs.1000",
      category: "Mathara",
      image: "https://bncfin.com/wp-content/uploads/2017/03/qtq80-PRo6uY-1024x683.jpeg",
      url: "http://localhost/SeatBooking/bus2"
    },
    {
      productName: "Galle - Kandy-Rs.2000",
      category: "Kandy",
      image: "https://th.bing.com/th/id/OIP.XlyFJeTnYl1YX3tZWpnD5QHaGN?w=940&h=788&rs=1&pid=ImgDetMain",
      url: "http://localhost/SeatBooking/bus3"
    },
    {
      productName: "Galle - Hambanthota-Rs.1500",
      category: "Hambanthota",
      image: "https://th.bing.com/th/id/OIP.B1AluJyTKSBnRpBj6-FCHAHaE9?rs=1&pid=ImgDetMain",
      url: "http://localhost/SeatBooking/bus4"
    },
    {
      productName: "Galle -Colombo-Rs.1950",
      category: "Colombo",
      image: "https://live.staticflickr.com/65535/49952483913_7c57295fc3_b.jpg",
      url: "http://localhost/SeatBooking/bus5"
    },
    {
      productName: "Galle - Mathara-Rs.1000",
      category: "Mathara",
      image: "https://www.shaadibaraati.com/vendors-profile/1571202707.jpg",
      url: "http://localhost/SeatBooking/bus6"
    },
    {
      productName: "Galle - Kandy-Rs.2000",
      category: "Kandy",
      image: "https://3.imimg.com/data3/AE/OX/MY-8235007/1253866529a-500x500.jpg",
      url: "http://localhost/SeatBooking/bus7"
    },
    {
      productName: "Galle - Hambanthota-Rs.1500",
      category: "Hambanthota",
      image: "https://eaglebus.in/Buses/large/Al_DSC_5162.JPG",
      url: "http://localhost/SeatBooking/bus8"
    },{
      productName: "Galle - Colombo-Rs.1950",
      category: "Colombo",
      image: "https://th.bing.com/th/id/OIP.KGrl5xeRczuVTKKnPyYsuQHaEn?w=1772&h=1106&rs=1&pid=ImgDetMain",
      url: "http://localhost/SeatBooking/bus9"
    },
  ],
};

for (let i of products.data) {
  //Create Card
  let card = document.createElement("div");
  //Card should have category and should stay hidden initially
  card.classList.add("card", i.category, "hide");
  //image div
  let imgContainer = document.createElement("div");
  imgContainer.classList.add("image-container");
  //anchor tag
  let anchor = document.createElement("a");
  anchor.href = i.url;
  //img tag
  let image = document.createElement("img");
  image.setAttribute("src", i.image);
  image.onclick = function (event) {
    event.preventDefault();
    window.location.href = i.url;
  };
  anchor.appendChild(image);
  imgContainer.appendChild(anchor);
  card.appendChild(imgContainer);
  //container
  let container = document.createElement("div");
  container.classList.add("container");
  //product name
  let name = document.createElement("h5");
  name.classList.add("product-name");
  name.innerText = i.productName.toUpperCase();
  container.appendChild(name);
  //booking button
  let bookingButton = document.createElement("button");
  bookingButton.classList.add("booking-button");
  bookingButton.innerText = "View Details";
  bookingButton.onclick = function () {
    window.location.href = i.url;
  };
  container.appendChild(bookingButton);
  //append container to card
  card.appendChild(container);
  //append card to products
  document.getElementById("products").appendChild(card);
}
//parameter passed from button (Parameter same as category)
function filterProduct(value) {
  //Button class code
  let buttons = document.querySelectorAll(".button-value");
  buttons.forEach((button) => {
    //check if value equals innerText
    if (value.toUpperCase() == button.innerText.toUpperCase()) {
      button.classList.add("active");
    } else {
      button.classList.remove("active");
    }
  });

  //select all cards
  let elements = document.querySelectorAll(".card");
  //loop through all cards
  elements.forEach((element) => {
    //display all cards on 'all' button click
    if (value == "all") {
      element.classList.remove("hide");
    } else {
      //Check if element contains category class
      if (element.classList.contains(value)) {
        //display element based on category
        element.classList.remove("hide");
      } else{
        //hide other elements
        element.classList.add("hide");
      }
    }
  });
}

//Search button click
document.getElementById("search").addEventListener("click", () => {
  //initializations
  let searchInput = document.getElementById("search-input").value;
  let elements = document.querySelectorAll(".product-name");
  let cards = document.querySelectorAll(".card");

  //loop through all elements
  elements.forEach((element, index) => {
    //check if text includes the search value
    if (element.innerText.includes(searchInput.toUpperCase())) {
      //display matching card
      cards[index].classList.remove("hide");
    } else {
      //hide others
      cards[index].classList.add("hide");
    }
  });
});

// Image click event
document.querySelectorAll(".image-container a img").forEach((img) => {
  img.addEventListener("click", (e) => {
    e.preventDefault();
    const product = getProductByImage(e.target.src);
    if (product) {
      document.getElementById("lightbox-image").src = product.image;
      document.getElementById("product-name").innerText =product.productName;
      document.getElementById("product-category").innerText = product.category;
      document.getElementById("product-url").href = product.url;
      document.getElementById("product-details").classList.remove("hide");
    }
    document.getElementById("lightbox").classList.remove("hide");
  });
});

// Lightbox close button
document.getElementById("lightbox-close").addEventListener("click", () => {
  document.getElementById("lightbox").classList.add("hide");
});

// Function to get product by image src
function getProductByImage(src) {
  return products.data.find((product) => product.image === src);
}

//Initially display all products
window.onload = () => {
  filterProduct("all");
};