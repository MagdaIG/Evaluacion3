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
    describe('CategoriaServicioIdBody', function() {
      beforeEach(function() {
        instance = new ApiDeEnergyAndWater.CategoriaServicioIdBody();
      });

      it('should create an instance of CategoriaServicioIdBody', function() {
        // TODO: update the code to test CategoriaServicioIdBody
        expect(instance).to.be.a(ApiDeEnergyAndWater.CategoriaServicioIdBody);
      });

      it('should have the property nombre (base name: "nombre")', function() {
        // TODO: update the code to test the property nombre
        expect(instance).to.have.property('nombre');
        // expect(instance.nombre).to.be(expectedValueLiteral);
      });

      it('should have the property imagen (base name: "imagen")', function() {
        // TODO: update the code to test the property imagen
        expect(instance).to.have.property('imagen');
        // expect(instance.imagen).to.be(expectedValueLiteral);
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

    });
  });

}));
