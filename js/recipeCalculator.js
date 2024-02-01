class RecipeCalculator {
  constructor() {
    this.servingsInput = document.getElementById("ingredient_servings");
    this.initValue = parseInt(this.servingsInput.value);
    this.ingredientElements = document.querySelectorAll(".recipe-ingredient .repeater-row");
    
    this.initIngredients();
    this.initEventListeners();
  }

  initIngredients() {
    this.ingredientElements.forEach((ingredientElement) => {
      const nameElement = ingredientElement.querySelector(".ingredient_amount");
      const name = nameElement.innerText;
      const value = this.extractValue(name);
      if (value !== null) {
        this.wrapNumberWithSpan(nameElement, value);
      }
    });
  }

  extractValue(text) {
    const value = text.match(/(\d+-\d+\/\d+|\d+\/\d+|\d+(\.\d+)?)/g);
    return value ? value[0] : null;
  }

  normalizeValue(text) {
    const numbers = text.match(/(\d+-\d+\/\d+|\d+\/\d+|\d+(\.\d+)?)/g);
    if (numbers) {
        const number = numbers[0];
        if (number.includes('-')) {
            const [wholeNumber, fraction] = number.split('-');
            const [numerator, denominator] = fraction.split('/');
            return parseInt(wholeNumber) + parseFloat(numerator) / parseFloat(denominator);
        } else if (number.includes('/')) {
            const [numerator, denominator] = number.split('/');
            return parseFloat(numerator) / parseFloat(denominator);
        } else {
            return parseFloat(number);
        }
    }
    return null;
}

wrapNumberWithSpan(element, number) {
  const originalText = element.innerText;
  const span = document.createElement("span");
  const normalizedNumber = this.normalizeValue(originalText);
  span.classList.add("ingredient_number");
  
  span.innerText = normalizedNumber;
  span.dataset.number = normalizedNumber;

  const newText = originalText.replace(number.toString(), span.outerHTML);
  element.innerHTML = newText;
}


  initEventListeners() {
    this.servingsInput.addEventListener("input", () => {
      this.updateServings();
    });
  }

  updateServings() {
    const servings = parseInt(this.servingsInput.value);
    this.ingredientElements.forEach((ingredient) => {
      const numberElement = ingredient.querySelector(".ingredient_number");
      if (numberElement) {
        const originalNumber = numberElement.dataset.number;
        const newNumber = (originalNumber / this.initValue) * servings;
        numberElement.innerText = newNumber.toFixed(2); // Adjust formatting as needed
      }
    });
  }
};

document.addEventListener('DOMContentLoaded', function() {
  const recipeCalculator = new RecipeCalculator();
});