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
    describe('PreguntaFrecuenteIdBody1', function() {
      beforeEach(function() {
        instance = new ApiDeEnergyAndWater.PreguntaFrecuenteIdBody1();
      });

      it('should create an instance of PreguntaFrecuenteIdBody1', function() {
        // TODO: update the code to test PreguntaFrecuenteIdBody1
        expect(instance).to.be.a(ApiDeEnergyAndWater.PreguntaFrecuenteIdBody1);
      });

      it('should have the property pregunta (base name: "pregunta")', function() {
        // TODO: update the code to test the property pregunta
        expect(instance).to.have.property('pregunta');
        // expect(instance.pregunta).to.be(expectedValueLiteral);
      });

      it('should have the property respuesta (base name: "respuesta")', function() {
        // TODO: update the code to test the property respuesta
        expect(instance).to.have.property('respuesta');
        // expect(instance.respuesta).to.be(expectedValueLiteral);
      });

      it('should have the property activo (base name: "activo")', function() {
        // TODO: update the code to test the property activo
        expect(instance).to.have.property('activo');
        // expect(instance.activo).to.be(expectedValueLiteral);
      });

    });
  });

}));
