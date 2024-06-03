/*
 * API de Energy and Water
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 *
 * Swagger Codegen version: 3.0.57
 *
 * Do not edit the class manually.
 *
 */
(function(root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD.
    define(['expect.js', '../../src/index'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // CommonJS-like environments that support module.exports, like Node.
    factory(require('expect.js'), require('../../src/index'));
  } else {
    // Browser globals (root is window)
    factory(root.expect, root.ApiDeEnergyAndWater);
  }
}(this, function(expect, ApiDeEnergyAndWater) {
  'use strict';

  var instance;

  describe('(package)', function() {
    describe('EquipoIdBody1', function() {
      beforeEach(function() {
        instance = new ApiDeEnergyAndWater.EquipoIdBody1();
      });

      it('should create an instance of EquipoIdBody1', function() {
        // TODO: update the code to test EquipoIdBody1
        expect(instance).to.be.a(ApiDeEnergyAndWater.EquipoIdBody1);
      });

      it('should have the property tipo (base name: "tipo")', function() {
        // TODO: update the code to test the property tipo
        expect(instance).to.have.property('tipo');
        // expect(instance.tipo).to.be(expectedValueLiteral);
      });

      it('should have the property texto (base name: "texto")', function() {
        // TODO: update the code to test the property texto
        expect(instance).to.have.property('texto');
        // expect(instance.texto).to.be(expectedValueLiteral);
      });

      it('should have the property activo (base name: "activo")', function() {
        // TODO: update the code to test the property activo
        expect(instance).to.have.property('activo');
        // expect(instance.activo).to.be(expectedValueLiteral);
      });

      it('should have the property imagenes (base name: "imagenes")', function() {
        // TODO: update the code to test the property imagenes
        expect(instance).to.have.property('imagenes');
        // expect(instance.imagenes).to.be(expectedValueLiteral);
      });

    });
  });

}));
