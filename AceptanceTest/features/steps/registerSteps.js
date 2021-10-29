const { When, Then, Given, setDefaultTimeout } = require('cucumber');
const { Builder, By, until } = require('selenium-webdriver');
require('chromedriver');
//setDefaultTimeout(5 * 5000);
const assert = require('assert');

Given('I am on the {string} page', { timeout: 6 * 5000 }, async function (string) {
    this.driver = new Builder()
        .forBrowser('chrome')
        .build();
    await this.driver.get(`http://127.0.0.1:8000/${string}`);
});

When('I sign in with {string}, {string}, {string} and {string}', async function (string, string2, string3, string4) {
    this.driver.findElement(By.id("name")).sendKeys(string);
    this.driver.findElement(By.id("email")).sendKeys(string2);
    this.driver.findElement(By.id("password")).sendKeys(string3);
    this.driver.findElement(By.id("password_confirmation")).sendKeys(string4);
    this.driver.findElement(By.className("register")).click();
});

Then('I should see a message saying {string}', { timeout: 6 * 5000 }, async function (string) {
    await this.driver.wait(until.elementLocated(By.id("welcome-message")));
    let message = await this.driver.findElement(By.id("welcome-message")).getText();
    //assert.equal(string, message);
    assert.equal(string, message.substring(0, message.indexOf("!") + 1));
});
